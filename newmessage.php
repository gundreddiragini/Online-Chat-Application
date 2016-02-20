
<?php

//Each user sets a column of a corresponding row in a table when sending a message to his/her friends in order for their friends to get a new message pop up 
      $link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ;


$name1 =$_GET['createnewmsg'];
$name2=$_GET['myemail'];


$query2 = 'update newmessage set isnew=1 where messaging="'.$name1.$name2.'"';


$result = mysql_query($query2);

?>