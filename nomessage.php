
<?php

//User needs to adjust the newmessage table after seeing the newly poped up message 
      $link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ;


$name1 =$_GET['createnewmsg'];
$name2=$_GET['myemail'];


$query2 = 'update newmessage set isnew=0 where messaging="'.$name2.$name1.'"';




$result = mysql_query($query2);

$query3 = 'select fname, lname from users where email="'.$name1.'"';
$result3 = mysql_query($query3);

$row1 = mysql_fetch_array($result3, MYSQL_ASSOC);

$p1=$row1['fname'];
$p2=$row1['lname'];



echo 'document.getElementById("'.$p1.$p2.'").innerHTML="'.$p1.'&nbsp;'.$p2.'",';



echo 'document.getElementById("'.$p1.$p2.'link").innerHTML="'.$p1.'&nbsp;'.$p2.'"';


?>