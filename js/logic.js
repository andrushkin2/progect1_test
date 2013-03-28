var self;
var logic={
    init:function(parent,id){
        logic.posting(parent,id);
    },
    posting:function(parent,id){
        $.getJSON(
            'http://salto.extreme.by/Project1/data.php?callback=?',
            {i:id},
            function (data) {
                $('#'+parent).attr('style','display:inline-block');
                this.app=new create_body(parent,id);
                //console.log('response', response);
                switch (data.day){
                    case 'Sunday':
                        self.week.innerHTML='воскресенье';
                        break;
                    case 'Monday':
                        self.week.innerHTML='понедельник';
                        break;
                    case 'Tuesday':
                        self.week.innerHTML='вторник';
                        break;
                    case 'Wednesday':
                        self.week.innerHTML='среда';
                        break;
                    case 'Thursday':
                        self.week.innerHTML='четверг';
                        break;
                    case 'Friday':
                        self.week.innerHTML='пятница';
                        break;
                    case 'Saturday':
                        self.week.innerHTML='cуббота';
                        break;
                }
                self.date.innerHTML=data.date;
                self.number.innerHTML=data.col;

                var height=self.first.clientHeight;
                var width=self.first.clientWidth;
                self.but.style.height=height+"px";
                self.but.style.width=width/2+"px";
                self.button.style.height=height+"px";
                self.button.style.width=width/2+"px";
            }
        );
    }
}
var create_body=function(parent,id){
    self=this;
    this.body=document.getElementById(parent);
    this.first=document.createElement('div');
    this.first.setAttribute('style','background: rgb(132,194,37);min-width: 150px;display: inline-block;-webkit-border-radius:20px;' +
        '-khtml-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;');
    this.info=document.createElement('div');

    //info div
    this.info.setAttribute('style','text-align: center;min-width:64px;display: inline-block;padding:0px 10px;float: left');
    //week div
    this.week=document.createElement('div');
    this.week.setAttribute('style','font-size: 12px;color:white');
    this.week.setAttribute('t','week');
    /*this.text=document.createTextNode('day of week');
    this.week.appendChild(this.text);*/
    this.info.appendChild(this.week);
    //date
    this.date=document.createElement('div');
    this.date.setAttribute('style','font-size: 12px;margin-top: -2px;;color:white');
    this.date.setAttribute('t','date');
    /*this.text1=document.createTextNode('date');
    this.date.appendChild(this.text1);*/
    this.info.appendChild(this.date);
    //number
    this.number=document.createElement('div');
    this.number.setAttribute('style','font-size: 43px;margin-top: -11px;color:white');
    this.number.setAttribute('t','number');
    /*this.text2=document.createTextNode('45');
    this.number.appendChild(this.text2);*/
    this.info.appendChild(this.number);
    //count
    this.count=document.createElement('div');
    this.count.setAttribute('style','font-size: 12px;margin-top: -14px;color:white');
    this.count.setAttribute('t','count');
    this.text3=document.createTextNode('мест');
    this.count.appendChild(this.text3);
    this.info.appendChild(this.count);
    this.first.appendChild(this.info);

    //button
    this.but=document.createElement('div');
    this.but.setAttribute('style','display: inline-block;float:right;-webkit-border-radius:20px;-khtml-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;');
    //button
    this.button=document.createElement('input');
    this.button.setAttribute('type','button');
    this.button.setAttribute('style','font-size: 48px;background: rgb(218,37,29);color: white;padding: 0px;margin: 0px;' +
            '-webkit-border-radius:20px;-khtml-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px');
    this.button.setAttribute('value','+1');
    this.button.setAttribute('onclick',"document.location.href='http://salto.extreme.by/Project1/?num="+id+"&url="+document.location.href+"'");
    this.but.appendChild(this.button);
    this.first.appendChild(this.but);

    //compil first
    this.body.appendChild(this.first);
}
