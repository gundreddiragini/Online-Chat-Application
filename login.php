<?php

session_start();


  //Getting the details of the user based on the login emailid 

$link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ;

$temp=$_GET['emailid'];



$query='select fname, lname, status from users where email="'.$temp.'"';

$result = mysql_query($query);

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

	$_SESSION['name']=$row['fname'].$row['lname'];
$_SESSION['fname']=$row['fname'];

  if($row['status']==0){
unset($_SESSION['email']);
unset($_SESSION['name']); 
unset($_SESSION['fname']); 

  exit();
}

}





$_SESSION['email'] = $_GET['emailid'];

//Task to be performed when user logged out of his account
if(isset($_GET['logout']))
{
unset($_SESSION['email']);
unset($_SESSION['name']);	
unset($_SESSION['fname']);	

	$link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ;

$query1='update users set status =0 where email="'.$temp.'"';

$result1 = mysql_query($query1);

//redirecting the user to login page
header("Location: index.php");
exit();
}


//Task to be executed when user adds a new friend
if(isset($_GET['emailidadd']))
{

$namedetails=$_GET['emailid'];
$emailidad=$_GET['emailidadd'];
	$link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ; 
$query = 'insert into friends values("'.$namedetails.'","'.$emailidad.'")';


$result = mysql_query($query);

$one=0;


}


?>







<!DOCTYPE html>
<html>
<head>
<title>chat</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/mystyles.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap-social.css" rel="stylesheet">
<link rel="stylesheet" href="http://www.css/ui-lightness/jquery-ui-1.8.2.custom.css" type="text/css" media="screen" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


</script>
</head>



<body>
	<div id="chattingstart" style="border-right:solid #0044cc 2px; padding:5px ">
    <h1 id="heading" style="color:#0044cc"><?php echo $_SESSION['fname'];?>,</h1>
		<h4 style="color:#0044cc">Hang on a chat with...</h4>
			
			<?php


{

	$querystring=$_GET['emailid'];


	$link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ; 

$query='select fname, lname, email from users where email in (select friend from friends where user="'.$querystring.'")';
$result = mysql_query($query);
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
{


	?>

  <!--Displaying user's friends -->
	<button id="<?=$row['fname']?><?=$row['lname']?>" class="btn btn-default btn-md btn-block" name="<?=$row['email']?>"><?=$row['fname']?> &nbsp;<?=$row['lname']?></button>
	<?php
$link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ; 



$query2 = 'insert into newmessage values("'.$row['email'].$_SESSION['email'].'",0)';

$result1 = mysql_query($query2);

}


}



?>

	</div>
	<!--Chat window of the user -->
	<div id="chattingstuff">

<!--Option panel of the user (For searching and Adding friends) . Panel also supports user logout -->
	<form enctype="multipart/form-data" method="get" action="search.php">
		<button id="addfriend" class="btn btn-primary btn-md " style="position: absolute; top: 5px; right: 450px" name="addfriend">Add Friend</button>
	<input type="text" name="name" value="<?=$_GET['emailid']?>" hidden></input>
</form>


	<form enctype="multipart/form-data" method="get" action="login.php">

		<button id="logout" class="btn btn-primary btn-md " style="position: absolute; top: 5px; right: 350px" name="logout">Log Out</button>
		<input type="text" name="emailid" value="<?=$_GET['emailid']?>" hidden></input>
	</form>

<!--Notification panel of the user -->
	<div class="panel-group" id="accordion"
                      role="tablist" aria-multiselectable="true" style="position: absolute; right: 30px; top:5px; width: 300px">
            <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingnotify">
                            <h3 class="panel-title">
                                <a role="button" data-toggle="collapse"
                                     data-parent="#accordion" href="#notifycenter"
                                     aria-expanded="true" aria-controls="notifycenter">
                                    Notification</a>
                            </h3>
                            </div>        
                <div role="tabpanel" class="panel-collapse collapse in"
                             id="notifycenter"    aria-labelledby="headingnotify" >
                            <div class="panel-body" style="height:200px; overflow:auto">
                

                <?php 
                
               $querystring=$_GET['emailid'];
                $link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ; 


$query='select user from friends where (friend="'.$querystring.'") and (user not in (select friend from friends where user="'.$querystring.'"))'; 
$result = mysql_query($query);
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
	{?>
<!--Displaying friend requests for the user -->
<form enctype="multipart/form-data" method="get" action="notification.php">
        <input type="text" id="" style="background-color: orange;" value="<?=$row['user']?>" disabled></input> 
        <button id="" class="btn btn-default btn-xs btn-success" type="submit" name="yesorno" value="yes">YES</button>
        <button id="" class="btn btn-default btn-xs btn-danger" type="submit" name="yesorno" value="no">NO</button>
        <input type="text" name="emailid" value="<?= $querystring?>" hidden></input>
        <input type="text" name="addorno" value="<?=$row['user']?>" hidden></input> </form>
	<?php

}
 
                ?>

                
            </div>
        </div>
    </div>
</div>


	</div>


<script type="text/javascript" id="myscript">
count=0;


$("button").click(function() {

   

var parentname=document.getElementById($(this).attr('id')).parentNode;
var name= parentname.getAttribute('id');

//getting the details of the button that is clicked in order to open the appropriate chat box
if(name=="chattingstart" && !document.getElementById($(this).attr('id')+"ichat0")){


var chattingbox=document.createElement("div");

    chattingbox.setAttribute("id","chattingboxes"+$(this).attr('id'));
    
    chattingbox.setAttribute("class","boxeschatting");
    chattingbox.setAttribute("role","tablist");
    chattingbox.setAttribute("aria-multiselectable","true");
    chattingbox.style.width="250px";
    
     chattingbox.style.position="absolute";
     chattingbox.style.bottom="2px";
     chattingbox.style.left=((count*250)+(count+1)*2+"px");
    


     var cbheader1= document.createElement("div");
     cbheader1.setAttribute("class","panel panel-default");
    

     var cbheader= document.createElement("div");
     cbheader.setAttribute("class","panel-heading");
     cbheader.setAttribute("role","tab");
     cbheader.setAttribute("id","headingchat");
     cbheader.style.height="35px";
    

    var sp=document.createElement("button");
     sp.setAttribute("id","close");
     sp.setAttribute("onclick","this.parentNode.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode.parentNode); closetab()")
     var t1 = document.createTextNode("X");
     
    sp.style.position="absolute";
     sp.style.right="0px";
     sp.style.display="inline-block";
     sp.style.padding="2px 5px";
     sp.style.background="#ccc";
     sp.style.height="20px";
     sp.appendChild(t1);
  

          var h3=document.createElement("h3");
     h3.setAttribute("class","panel-title");
     h3.style.display="inline-block";
  

var a1=document.createElement("a");
a1.setAttribute("role","button");
a1.setAttribute("data-toggle","collapse");
var traceparent="#chattingboxes"+$(this).attr('id');
a1.setAttribute("data-parent",traceparent);
a1.setAttribute("href","#"+$(this).attr('id')+"chat");
a1.setAttribute("id",$(this).attr('id')+"link");
a1.setAttribute("aria-expanded","true");
a1.setAttribute("aria-controls",$(this).attr('id')+"chat");
var friendname=document.getElementById($(this).attr('id')).textContent;

var t = document.createTextNode(friendname);
a1.appendChild(t);
h3.appendChild(a1);
cbheader.appendChild(h3);
cbheader.appendChild(sp);

    


cbheader1.appendChild(cbheader);

var cbbody1=document.createElement("div");
cbbody1.setAttribute("role","tabpanel");
cbbody1.setAttribute("class","panel-collapse collapse in");
cbbody1.setAttribute("id",$(this).attr('id')+"chat");
cbbody1.setAttribute("aria-labelledby","headingchat");




var cbbody=document.createElement("div");
cbbody.setAttribute("class","panel-body");
cbbody.style.height="350px";


var chattingbox2=document.createElement("div");
    chattingbox2.setAttribute("id",$(this).attr('id')+"ichat0");
    chattingbox2.style.width="246px";
     chattingbox2.style.height="315px";
     chattingbox2.style.padding="5px 5px 10px 5px";
     chattingbox2.style.position="absolute";
     chattingbox2.style.top="36px";
     chattingbox2.style.left="1px";
     chattingbox2.style.overflow="auto";

     var ichattingbox1=document.createElement("div");
    ichattingbox1.setAttribute("id",$(this).attr('id')+"ichat1");
    ichattingbox1.style.width="246px";
    ichattingbox1.style.margin="0 auto";
    ichattingbox1.style.position="absolute";
    ichattingbox1.style.top="351px";
    ichattingbox1.style.left="1px";
     ichattingbox1.style.height="32px";
     


     var ichattingbox11=document.createElement("input");
  ichattingbox11.setAttribute("id",$(this).attr('id')+"ichat11");
  ichattingbox11.setAttribute("type","text");
  ichattingbox11.setAttribute("name","usermsg");
  ichattingbox11.style.width="189px";

  var ichattingbox12=document.createElement("input");
  ichattingbox12.setAttribute("id",$(this).attr('id'));
  ichattingbox12.setAttribute("type","button");
  ichattingbox12.setAttribute("name",$(this).attr('name'));
  ichattingbox12.setAttribute("value","Send");
var sending=$(this).attr('id')+"ichat12";
  ichattingbox12.setAttribute("onclick","delivermsg(this.id,this.name)");
    
ichattingbox1.appendChild(ichattingbox11);
ichattingbox1.appendChild(ichattingbox12);


//opening the appropriate chat box based on user selection of one particular friend to chat
cbbody.appendChild(chattingbox2);
cbbody.appendChild(ichattingbox1);
cbbody1.appendChild(cbbody);
cbheader1.appendChild(cbbody1);
chattingbox.appendChild(cbheader1);
var chattingbox1= document.getElementById("chattingstuff");
     chattingbox1.appendChild(chattingbox);


count=count+1;


	
}

});

//action performed when user is sending a messaage to any friend
function delivermsg(chatmsg,name11){
	
	 var clientmsg = $("#"+chatmsg+"ichat11").val();
	   
var name=name11+"<?= $_SESSION['email']?>"+".html";
var name2="<?= $_SESSION['email']?>"+name11+".html";
var n = name.localeCompare(name2);

if(n==1)
{
  filename1=name2;
}
else
{
 filename1=name; 
}




$.post("post.php", {text: clientmsg, filename: filename1});
      document.getElementById(chatmsg+"ichat11").value="";



     var temp='newmessage.php?createnewmsg='+name11+'&myemail=<?=$_SESSION['email']?>';
    

$.ajax({
               url: temp,
               type: "GET",
               
               statusCode: {404:function() {alert("404 error")}}
               
             }).done(function(data, status, jqXHR) {

          }); 


      return false;

}


//action to be performed when some of the chatting tabs are closed
function closetab(){

   
  count=0;
  
   var chats=document.getElementById("chattingstuff");
   var moveleft=chats.childNodes;
   var i;
    for (i = 0; i < moveleft.length; i++) {
      
        if(moveleft[i].className=="boxeschatting")
      {
        moveleft[i].style.left=((count*250)+(count+1)*2+"px");
        
        count=count+1;
      }

}

return false;

}


 
  setInterval (loadLog, 2500);
                              

//Function for loading the previous messaages of the chat box that is currently opened 
function loadLog(){
	var allchats=document.getElementById("chattingstuff");

var c = allchats.childNodes;


var i;
    for (i = 0; i < c.length; i++) {

        if(c[i].className=="boxeschatting")
    {

var chatboxarea=c[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0];


var oldscrollHeight=chatboxarea.scrollHeight;

var sendbutton=c[i].childNodes[0].childNodes[1].childNodes[0].childNodes[1].childNodes[1].id;
var sendname=c[i].childNodes[0].childNodes[1].childNodes[0].childNodes[1].childNodes[1].name;


var name=sendname+"<?= $_SESSION['email']?>"+".html";
var name2="<?= $_SESSION['email']?>"+sendname+".html";
var n = name.localeCompare(name2);

if(n==1)
{
  filename1=name2;
}
else
{
 filename1=name; 
}


var urlvariable=filename1;

    $.ajax({ url: urlvariable,
             cache: false,
             async: false,
             success: function(html){
             	
                document.getElementById(chatboxarea.id).innerHTML = html;
                var newscrollHeight = chatboxarea.scrollHeight;
                
                if(newscrollHeight > oldscrollHeight){
                                
                chatboxarea.scrollTop = chatboxarea.scrollHeight;

                }
             },
    });


var temp='nomessage.php?createnewmsg='+sendname+'&myemail=<?=$_SESSION['email']?>';

$.ajax({
               url: temp,
               type: "GET",
               async: false,
               
               statusCode: {404:function() {alert("404 error")}}
               


             }).done(function(data, status, jqXHR) {

              eval(data);

          }); 


}
}
}


//Adjusting the display of the user's home page
var divdimensions=document.getElementsByTagName("div")[0];
divdimensions.style.position="absolute";
divdimensions.style.width="20%";
divdimensions.style.height="100%";
divdimensions.style.left="0%";
divdimensions.style.top="0";


var divdimensions1=document.getElementsByTagName("div")[1];


divdimensions1.style.position="absolute";
divdimensions1.style.left="20%";
divdimensions1.style.height="100%";
divdimensions1.style.width="80%";
divdimensions1.style.top="0";



setInterval (loadonline, 2500);


//Function to check the online status of user's friends
function loadonline(){
  
  <?php $querystring=$_GET['emailid']; ?>
	var temp1="<?= $querystring ?>";
  

	var temp="online.php?emailid='"+temp1+"'";
$.ajax({
               url: "online.php",
               type: "POST",
               data: "emailid=" + temp1,
               dataType: 'html',
               statusCode: {404:function() {alert("404 error")}}
               


             }).done(function(data, status, jqXHR) {
eval(data);


					});


}






</script>
<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</body>

</html>