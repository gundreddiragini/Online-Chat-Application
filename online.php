
<?php
 $querystring=$_POST['emailid'];
$link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ; 
$query='select fname, lname, status, email from users where email in (select friend from friends where user="'.$querystring.'")';
$result = mysql_query($query);
$count =0;
$count1 =0;

//PHP file for continuously monitoring the online status of friends of a logged in user
while ($row = mysql_fetch_array($result, MYSQL_ASSOC))


{
	if($count!=0)
	{
		echo ',';
	}

$p=$row['status'];
$p1=$row['fname'];
$p2=$row['lname'];
$p3=$row['email'];




$query1='select isnew from newmessage where messaging="'.$querystring.$p3.'"';
$result1 = mysql_query($query1);
$row1 = mysql_fetch_array($result1, MYSQL_ASSOC);

//Managing the new messages recieved by a user

if($row1['isnew']==1){


	echo 'document.getElementById("'.$p1.$p2.'").innerHTML="'.$p1.'&nbsp;'.$p2.'",';
	echo 'document.getElementById("'.$p1.$p2.'").innerHTML+="&nbsp;<b style=\"color:red\">+</b>",';
	echo 'audio = new Audio("pop.mp3"),';
	echo 'audio.play()';	
$count1=$cpunt+1;
}

if($count1!=0)
	{
		$count1=0;
		echo ',';
	}

$count=$cpunt+1;	

	{
if($p==1)
	{

echo 'document.getElementById("'.$p1.$p2.'").setAttribute("class","btn btn-success btn-md btn-block")';

	}

	else

	{


echo 'document.getElementById("'.$p1.$p2.'").setAttribute("class","btn btn-default btn-md btn-block")';

 

	}
}


}
?>


