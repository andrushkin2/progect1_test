<?php

include_once("server/config.php");
include_once("server/readyuser.php");

$user = new ReadyUser();
$user->logout("index.php");

?>