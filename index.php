<?php
session_start();

//checking if someuser is already logged in in the current session 
if(isset($_SESSION['email'])){

header("Location: login.php?emailid=".$_SESSION['email']."");

}


if(isset($_POST['connect']))
{



$link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ;


$query='select * from users';

$result = mysql_query($query);
$one=0;

//Checking if the user is having all the permitions to login into his/her account 
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
{ 


if($row['email']==$_POST['email'])
{
	$one=2;
$link1=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ;
$temp=$row['email'];


$query1='select password from users where email="'.$temp.'"';

$result1 = mysql_query($query1);
while ($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)) {

if($row1['password']==$_POST['passwordfield'])
{
$one=1;
}

}

if($one==1){
$link2=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ;
$temp2=$row['email'];


$query2='select status from users where email="'.$temp2.'"';

$result2 = mysql_query($query2);
while ($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)) {

if($row2['status']==1)
{
$one=100;
}

}
}

}



}



//Logging the user into his/her account (When all requirements are satisfied)

if($one==1)
{
	$temp=$_POST['email'];

	$link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ;

$query1='update users set status =1 where email="'.$temp.'"';
$result1 = mysql_query($query1);


	header("Location: login.php?emailid=".$temp."");
	exit();
}


// action when user with given email id does not exist
if($one==0)
{
	$nouser="There is no user with this email";


}


//action when password is not entered correctly
if($one==2)
{
	$notpassword="Given credentials are not in database";


}


//action when user is trying to login more than once
if($one==100)
{
	$nouser="You cannot login more than once into an account";


}

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
</head>

<body>

<div class="container" id="outer">
<div class="row" id="loginpage">

	<form  class="form-horizontal" role="form" action="index.php" enctype="multipart/form-data" method="post">

		<h1>Login into Chat World</h1>
		<br><br>
	                   
		              <!--LOGIN FORM-->

	                   <div class="form-group">
	                   	
	                   	<label class="col-sm-2 control-label" for="email">Email Id</label>
	                                		
	                   		<div class="col-sm-10">
			                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your Email ID" value="<?= $_POST['email']?>" required><?php echo "<b style=\"color: red \">".$nouser."</b>";   ?>

	                        </div>
	                   </div>

	                   <div class="form-group">
	                   	
	                   	<label class="col-sm-2 control-label" for="passwordfield">Password</label>
	                   		
	                   		<div class="col-sm-10">
			                  <input type="password" class="form-control" id="passwordfield" name="passwordfield" placeholder="Password" required><?php echo "<b style=\"color: red \">".$notpassword."</b>";   ?>

	                        </div>
	                   </div>

	                   <button type="submit" class="btn btn-info btn-md col-sm-offset-2" name="connect">Sign in</button>&nbsp;&nbsp;&nbsp;
	                   <a href="registering.php">New User?</a>

    </form>
</div>

</div>
	 
		
                   
                             
<!--Setting the dimensions of the login page-->

<script type="text/javascript">

var divdimensions=document.getElementById("loginpage");

divdimensions.style.width="500px";

var divdimensions1=document.getElementsByTagName("div")[0];


divdimensions1.style.position="absolute";
divdimensions1.style.left="300px";
divdimensions1.style.top="100px";


</script>
<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
	</body>
	</html>