<?php

if(isset($_GET['yesorno']))
{
	//PHP file that maintains user notifications
	if($_GET['yesorno']=='yes')
	{

$userdetails=$_GET['emailid'];
$frienddetails=$_GET['addorno'];
		
		 $link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ; 
$query = 'insert into friends values("'.$userdetails.'","'.$frienddetails.'")';
$result = mysql_query($query);

	}
		
	else
	{

		$userdetails=$_GET['emailid'];
$frienddetails=$_GET['addorno'];

		$link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ;
$query='delete from friends where user="'.$frienddetails.'" and friend="'.$userdetails.'"';
$result = mysql_query($query);

	}
		
}


if(isset($_GET['emailid']))
{
$userdetails=$_GET['emailid'];
header("Location: login.php?emailid=".$userdetails."");



}


?>
