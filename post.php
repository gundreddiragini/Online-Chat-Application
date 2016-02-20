<?php
session_start();
{

//PHP file for storing the chat messages into file systems
	      $link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ;

$query = 'select fname from users where email="'.$_SESSION['email'].'"';
$result = mysql_query($query);
$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
   $text = $_POST['filename'];
  
   $fp = fopen($text, 'a');
   
   fwrite($fp, "<div class='msgln'><small>".$row['fname']."&nbsp;(".date("g:i A")."):</small>&nbsp;<b>".$_POST['text']."</b> "."<br></div>");
   
   fclose($fp);
}
?>


