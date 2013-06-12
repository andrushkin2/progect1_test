<?php

class MenagerConf{
	static public $appName = "MyApp";
	static public $prefix = "";
	static public $template = "";
	static public $register = false;
	static public $restore = false;
	static public $remember = false;
	static public $loginLiveTime = 604800; //60*60*24*7 - 1 week
}
class ReadyUser{
	public $db;
	private $appName;
	private $prefix;
	private $loginError;
	private $extraInfo;

	public function __construct($appName = false, $conn=false, $dbtype = false, $prefix = false,$app_id = false, $app_secret = false, $google_secret = false,$google_id = false){
		@session_start();
		if ($appName === false)  $appName  = MenagerConf::$appName;
		if ($prefix === false) $prefix = MenagerConf::$prefix;

		$this->appName = $appName;

		$this->userVar = "dhxRU_".$appName."_id";
		$this->detailsVar = "dhxRU_".$appName."_data";
		$this->csrfVar = "dhxRU_".$appName."_csrf";
		$this->cookieVar = "dhxRU_".$appName;
		$this->propsVar = "dhxRU_".$appName."_props";

		$this->checkLoginAttempt();
	}

//////////////////////////////////////////
//			Password processing 		//
//////////////////////////////////////////

	private function salt(){
		mt_srand(microtime(true)*1000);
		$base_charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$salt = '';
		
  		for ($i=0; $i<22; $i++)
  			$salt .= $base_charset[mt_rand(0, 61)];

		return '$2a$08$'.$salt; 
	}

	public function hash($pass, $salt = false){
		if ($salt === false)
			$salt = $this->salt();

		return crypt($pass, $salt);
	}
	private function hasValidKey($user, $key=false){
		if ($key !== false)
			$user = $this->getByRestoreKey($key);

		if (!$user)
			return false;

		//key active only for 12 hours
		if ($user["restorekey"] != "" && (time() - strtotime($user["restoredate"])) < 12*60*60)
			return $user["restorekey"];
		
		return false;
	}
	private function change_password($pass, $key){
		$user = $this->getByRestoreKey($key);
		if ($key && $this->hasValidKey($user) == $key){
			$this->setPassword($user["id"], $pass);
			$this->setRestoreKey($user["id"],"");
			$this->loginError = "Password changed";
		} else {
			$this->loginError = "Restoration link expired";
			$this->echo_template("restore");
		}
	}
	private function send_restore_email($name){
		$user = $this->getByName($name);
		if (!$user){
			$this->loginError = "Not-existing user name";
			return false;
		}


		$path = MenagerConf::$template;
		if ($path != ""){

			$filename = $path."email.txt";
			if (is_file($filename)){

				$key = $this->hasValidKey($user);
				if ($key === false)
					$key = substr($this->salt(),7);
				$this->setRestoreKey($user["id"],$key);

				$url = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["SERVER_ADDR"].$_SERVER["SCRIPT_NAME"]."?dhxru=".$key."&action=change";
				$data = file_get_contents($filename);
				$data = str_replace("#name#", $user["name"], $data);
				$data = str_replace("#app#", $this->appName, $data);
				$data = str_replace("#url#", $url, $data);

				if (!mail($user["email"], "Request to reset your password", $data)){
					$this->loginError = "Can't send email";
					$this->echo_template("restore");
				}
				return true;
			}
		}
		$this->loginError = "Password restoration error";
		return false;
	}

//////////////////////////////////////////
//			  DB operations     		//
//////////////////////////////////////////

	public function setPassword($id, $pass){
		$id 	= $this->db->escape($id);
		$pass 	= $this->db->escape( $this->hash($pass) );

		$this->db->query("UPDATE {$this->prefix}users SET pass ='$pass' WHERE id='$id'");
	}
	public function setRestoreKey($id, $key){
		$id 	= $this->db->escape($id);
		$key 	= $this->db->escape( $key );
		$date   = date("Y-m-d H:m", time());

		$this->db->query("UPDATE {$this->prefix}users SET restorekey = '$key', restoredate = '$date' WHERE id='$id'");
	}
	public function setCookieKey($id, $key){
		$id 	= $this->db->escape($id);
		$key 	= $this->db->escape( $key );
		$this->db->query("UPDATE {$this->prefix}users SET cookiekey = '$key' WHERE id='$id'");
	}
	private function getByName($name){
		$name = escape($name);
		return $this->db->queryOne("SELECT * FROM {$this->prefix}users WHERE name='$name'");
	}
    private function getBySocNetId($id){
        $id=$this->db->escape($id);
        return $this->db->queryOne("SELECT * FROM {$this->prefix}users WHERE uid='$id'");
    }
	private function getById($id){
		$id = $this->db->escape($id);
		$res = $this->db->query("SELECT name FROM {$this->prefix}rights INNER JOIN rights2users ON rights.id = right_id WHERE user_id='$id'");
		$data = array();
		while ($set = $this->db->get_next($res)){
			$data[$set["name"]] = true;
		}
		return $data;
	}
	private function getByRestoreKey($key){
		$key = $this->db->escape($key);
		return $this->db->queryOne("SELECT * FROM {$this->prefix}users WHERE restorekey='$key'");
	}
	private function getByCookieKey($key){
		$key = $this->db->escape($key);
		return $this->db->queryOne("SELECT * FROM {$this->prefix}users WHERE cookiekey='$key'");		
	}
	private function getDetailsFromDB($id){
		$id = $this->db->escape($id);
		$data = $this->db->queryOne("SELECT props FROM {$this->prefix}users WHERE id='$id'");
		if ($data["props"])
			return json_decode($data["props"], true);
		return array();
	}
	private function putDetailsInDB($id, $data){
		$safe_data = array();
		foreach($data as $key => $value){
			$key = filter_var($key, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			$value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			$safe_data[$key] = $value;
		}

		$safe_data = $this->db->escape(json_encode($safe_data));
		$id = $this->db->escape($id);
		return $this->db->query("UPDATE {$this->prefix}users SET props = '$safe_data' WHERE id = '$id'");
	}
    private function addNewRecord($login,$pass){
        $login = escape($login);
        $pass = escape($pass);
        query("INSERT INTO {$this->prefix}users (uid,name, email, description, pass, restorekey, restoredate, cookiekey, props) VALUES ('','$login','$email','','','','0000-00-00 00:00:00','','[]')");
        $id = nextId();
        return $id;
    }
    
//////////////////////////////////////////
//			Registration API     		//
//////////////////////////////////////////

    private  function check_valid($login,$pass){
        if ($login=="" && $pass==""){
            $this->loginError="Invalid, fields cannot be blank";
            return false;
        }
        if ($login=="" && $pass!=""){
            $this->loginError="Invalid, login cannot be blank";
            return false;
        }
        if ($login!="" && $pass==""){
            $this->loginError="Invalid, password cannot be blank";
            return false;
        }
        $login=escape($login);
        $res=query("SELECT name FROM {$this->prefix}users WHERE name='$login'");
        if (!$res){
            $id=$this->addNewRecord($login,$pass);
            return true;
        }
        else{
            $this->loginError="This login is already used";
            return false;
        }
    }
    private function regBySocNet($id,$name,$site,$email=""){
        $id=$this->db->escape($id);
        $site=$this->db->escape($site);
        $name=$this->db->escape($name);
        $email=$this->db->escape($email);
        $res=$this->db->query("INSERT INTO {$this->prefix}users (uid,name, email, description, pass, restorekey, restoredate, cookiekey, props) VALUES ('$id','$site','$email','$name','','','0000-00-00 00:00:00','','[]')");
    }

//////////////////////////////////////////
//			  Public API        		//
//////////////////////////////////////////

	public function loginByCookie($key){
		$data = $this->getByCookieKey($key);
		if ($data !== null){
			$this->loginData($data, true);
		}
	}
    public function loginByGoogle($code,$my_url){
        if ($this->google_id==""){
            echo 'ReadyUser :: Google Client ID not found. <br> You need to set MenagerConf::$google_id';
            die();
        }
        if ($this->google_secret==""){
            echo 'ReadyUser :: Google Client secret not found. <br> You need to set MenagerConf::$google_secret';
            die();
        }
        $url ="https://accounts.google.com/o/oauth2/token";
        $data = array('code' => $code, 'client_id' => $this->google_id, 'client_secret' => $this->google_secret, 'redirect_uri' =>urldecode($my_url), 'grant_type' =>'authorization_code');
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $result=json_decode($result);
        $url="https://www.googleapis.com/oauth2/v1/userinfo?access_token=".$result->{'access_token'};
        $fql_query_result = file_get_contents($url);
        $fql_query_obj = json_decode($fql_query_result, true);
        $data=$this->getBySocNetId($fql_query_obj['id']);
        if (!$data){
            $this->regBySocNet($fql_query_obj['id'],$fql_query_obj['name'],"google",$fql_query_obj['email']);
            $data=$this->getBySocNetId($fql_query_obj['id']);
        }
        if ($data ===null){
            die('Error log in.Try again');
        }
        else{
            return $this->loginData($data,false);
        }
    }
    public function loginByFB($code,$my_url){
        // get user access_token
        if ($this->app_id==""){
            echo 'ReadyUser :: Facebook AppID not found. <br> You need to set MenagerConf::$app_id';
            die();
        }
        if ($this->app_secret==""){
            echo 'ReadyUser ::Facebook AppSecret not found. <br> You need to set MenagerConf::$app_secret';
            die();
        }
        $token_url = 'https://graph.facebook.com/oauth/access_token?client_id='
            . $this->app_id . '&redirect_uri=' . urlencode($my_url)
            . '&client_secret=' . $this->app_secret
            . '&code=' . $code;

        // response is of the format "access_token=AAAC..."
        $access_token = substr(file_get_contents($token_url), 13);
        // run fql query
        $fql_query_url = 'https://graph.facebook.com/me?access_token=' . $access_token;
        $fql_query_result = file_get_contents($fql_query_url);
        $fql_query_obj = json_decode($fql_query_result, true);
        $data=$this->getBySocNetId($fql_query_obj['id']);

        if (!$data){
            $this->regBySocNet($fql_query_obj['id'],$fql_query_obj['name'],"facebook");
            $data=$this->getBySocNetId($fql_query_obj['id']);
        }
        if ($data ===null){
            die('Error log in.Try again');
        }
        else{
            return $this->loginData($data,false);
        }
    }
	public function login($name, $pass, $remember=false){
		$data = $this->getByName($name);
		//login not found
		if ($data === null) return false;

		//check password hash
		if ($data["pass"] === $this->hash($pass, $data["pass"])){
			//correct
			return $this->loginData($data, $remember);
		} else {
			//wrong
			return false;
		}
	}
	private function loginData($data, $remember){
		//store user's id in session
		$id = $data["id"];
		$_SESSION[$this->detailsVar] = $this->getById($id);
		$_SESSION[$this->userVar] = $id;
		$_SESSION[$this->propsVar] = $data["props"]?json_decode($data["props"], true):array();

		if ($remember){
			$key = substr($this->salt(),7);
			$this->setCookieKey($id, $key);
			setcookie($this->cookieVar, $key, time()+MenagerConf::$loginLiveTime, "/", "", false, true);
		}

		return $id;
	}
	public function logout($page = false){
		//clear value 
		unset($_SESSION[$this->userVar]);
		unset($_SESSION[$this->detailsVar]);
		setcookie($this->cookieVar, "0", 1, "/", "", false, true);
		
		if ($page !== false){
			header("Location:".$page);
			die();
		}
	}

	public function hasRight($right=false){
		//get access rights from session
		if (!isset($_SESSION[$this->detailsVar]))
			$this->loginRedirect();

		//by default just check that user logged in
		if ($right === false) return true;
		//check specific rule
		$details = $_SESSION[$this->detailsVar];
		return isset($details[$right]);
	}

	public function check($right = false){
		if (!$this->hasRight($right)){
			$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
			header($protocol." 403 Forbidden");
			$this->echo_template("forbidden");
		}
	}
	private function echo_template($name){
		//for login form
		$user = "";
		if (isset($_POST['login']))
			$user = $_POST['login'];

		$path = MenagerConf::$template;
		$error = $this->loginError;
		$appName = $this->appName;
		$csrf = $this->csrfKey();
		$extra = $this->extraInfo;

		if ($path != ""){
			$filename = $path.$name.".php";
			if (is_file($filename)){
				include_once($filename);		
				die();
			}
		}
		echo 'ReadyUser :: template not found. <br> You need to set MenagerConf::$template';
		die();
	}


	public function getId(){
		//return id of currently logged-in user
		if (!isset($_SESSION[$this->userVar]))
			return false;

		return $_SESSION[$this->userVar];
	}

	public function getDetails($id = false){
		if (($id === false) || ($id == $this->getId()))
			return $_SESSION[$this->propsVar];
		else 
			return $this->getDetailsFromDB($id);
	}

	public function saveDetails($id, $data=false){
		if ($data === false){
			$data = $id;
			$id = $this->getId();
		}

		if ($id == $this->getId())
			$_SESSION[$this->propsVar] = $data;
		$this->putDetailsInDB($id, $data);
	}

	public function deleteDetail($id, $key){

	}

//////////////////////////////////////////
//	    		  Login form       		//
//////////////////////////////////////////

	private function loginRedirect(){
		$this->echo_template("login");
		die();
	}
	private function csrfKey(){
		if (!isset($_SESSION[$this->csrfVar]))
			$_SESSION[$this->csrfVar] = $this->salt();

		return $_SESSION[$this->csrfVar];
	}
	private function checkLoginAttempt(){
		//ready user form submit
		if (!isset($_GET["action"])){

            if (isset($_POST["register"])){
                if ($this->check_valid($_POST['login'],$_POST['pass'])){
                    if ($this->login($_POST['login'],$_POST['pass'])){
                        $this->echo_template('login');//check("Manage ReadyUser");
                        return true;
                    }
                    else{
                        $this->loginError = "Invalid login or password";
                        return false;
                    }
                }
                else{
                    $this->echo_template("register");
                    return false;
                }

            }

            if (isset($_POST["login"]) && isset($_POST["pass"])){
				// login form
				if (!$this->login($_POST["login"], $_POST["pass"], isset($_POST["remember"]))){
					$this->loginError = "Invalid login or password";
					return false;
				}
				return true; 
			} else if (isset($_POST["logout"])){
				// logout form
				$this->logout();
				return true;
			} else if (isset($_POST["restore"]) && isset($_POST["login"])){
				if ($this->send_restore_email($_POST["login"])){
					$this->echo_template("restore_confirm");
				} else {
					$this->echo_template("restore");
				}
			}else if (isset($_POST["change"])){
				$this->change_password($_POST["pass"], $_GET["dhxru"]);
			}
		} else if ( isset($_GET["action"])){
			switch($_GET["action"]){
				case "restore":
					$this->echo_template("restore");
					break;
				case "register":
					$this->echo_template("register");
					break;
				case "change":
					if ($this->hasValidKey(null, $_GET["dhxru"])){
						$this->echo_template("change");
					} else {
						$this->loginError = "Restoration link expired";
						$this->echo_template("restore");
					}
					break;
			}
		} else if (!$this->getId()){
            if (isset($_COOKIE[$this->cookieVar])){
                $cookie = $_COOKIE[$this->cookieVar];
                $this->loginByCookie($cookie);
            }
        }
	}
}