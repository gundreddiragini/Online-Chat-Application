<?php 
//PHP file for registering a new user.

if(isset($_POST['registering']))
{


$link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ;


$query='select * from users';

$one=0;
$result = mysql_query($query);

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$password=$_POST['passwordfield'];
$password2=$_POST['passwordfield2'];

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
{ 

//Checking to see if the email id already exist

if($row['email']==$_POST['email'])
{

	$one=1;

	$nissue="This email already exists";
}


}

//Checking to see if same password is entered twice or not

if($password != $password2)
{
	$one=1;

	$notsame="Enter the same password twice";

}

//Registering the user if all conditions are satisfied

if($one==0)
{



	$entry='insert into users values("'.$fname.'","'.$lname.'","'.$email.'","'.$password.'",0)';

	$entered=mysql_query($entry);
	header("Location: index.php");
	exit();


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


	<!--Registration form -->

<div class="container" id="outer">
<div class="row" id="loginpage">

	<form  class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="registering.php">

		<h1>Register yourself</h1>
		<br>
		<br>
	                   
		                    
	                   <div class="form-group">
	                   	
	                   	<label class="col-sm-4 control-label" for="fname">First Name *</label>
	                   		
	                   		<div class="col-sm-8">
			                  <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?= $fname?>" required>

	                        </div>
	                   </div>

	                   <div class="form-group">
	                   	
	                   	<label class="col-sm-4 control-label" for="lname">Last Name *</label>
	                   		
	                   		<div class="col-sm-8">
			                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?= $lname?>" required>

	                        </div>
	                   </div>

	                   <div class="form-group">
	                   	
	                   	<label class="col-sm-4 control-label" for="email">Email Id *</label>
	                   		
	                   		<div class="col-sm-8">
			                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter preferred Email ID" value="<?= $email?>" required><?php echo "<b style=\"color:red\">".$nissue."</b>"?>

	                        </div>
	                   </div>

	                   <div class="form-group">
	                   	
	                   	<label class="col-sm-4 control-label" for="passwordfield">Password *</label>
	                   		
	                   		<div class="col-sm-8">
			                  <input type="password" class="form-control" id="passwordfield" name="passwordfield" placeholder="Password" required>


	                        </div>
	                   </div>

	                   <div class="form-group">
	                   	
	                   	<label class="col-sm-4 control-label" for="passwordfield2">Re-enter Password *</label>
	                   		
	                   		<div class="col-sm-8">
			                  <input type="password" class="form-control" id="passwordfield2" name="passwordfield2" placeholder="Re-enter Password" required>
                              <?php echo "<b style=\"color:red\">".$notsame."</b>"?>
	                        </div>
	                   </div>

	                   <button type="submit" class="btn btn-info btn-md col-sm-offset-4" name="registering">Register</button>


    </form>
</div>

</div>
	 
		
                   
                             
<!--Adjusting the dimensions of the registration form -->
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