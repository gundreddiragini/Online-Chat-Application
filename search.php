


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
	<div style="border-right:solid #0044cc 2px; padding:5px ">
        
        
		
		<h4 id="heading" style="color:#0044cc">Hang on a chat with...</h4>

			<?php


{

	$querystring=$_GET['name'];

	
	$link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ; 

$query='select fname, lname from users where email in (select friend from friends where user="'.$querystring.'")';
$result = mysql_query($query);
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
{?>
	<!--Displaying user's friends -->
	<button id="<?=$row['fname']?><?=$row['lname']?>" class="btn btn-default btn-md btn-block" ><?=$row['fname']?> &nbsp;<?=$row['lname']?></button>
	<?php

}



}



?>
			


	</div>
	<div>
	<!--Chat window of the user -->
<form enctype="multipart/form-data" method="get" action="search.php">
	<button id="addfriend" class="btn btn-primary btn-md " style="position: absolute; top: 5%; right: 20%" name="addfriend">Add Friend</button>
		
	<input type="text" name="name" value="<?=$_GET['name']?>" hidden></input>
</form>
	
		
	
	<form enctype="multipart/form-data" method="get" action="login.php">

		<button id="logout" class="btn btn-primary btn-md " style="position: absolute; top: 5%; right: 10%" name="logout">Log Out</button>
		
<input type="text" name="emailid" value="<?=$_GET['name']?>" hidden></input>

	</form>


	</div>


<script type="text/javascript">


$(document).ready(function(){

	var divelement = document.getElementsByTagName("div")[1];
	
//Inserting the form for searching friends

	var formelement = document.createElement("form");
	formelement.style.width="500px";
	formelement.style.position="absolute";
	formelement.style.top="20px";
	formelement.style.left="20px";
    formelement.setAttribute('action','search.php');
    formelement.setAttribute('method','GET');
    formelement.setAttribute('enctype','multipart/form-data');

	var searchbox = document.createElement("input");
	searchbox.setAttribute('type','text');
	searchbox.style.width="250px";
	searchbox.placeholder="Enter the first name of your friend";
	searchbox.name="FirstName";
    
    var search = document.createElement("input");
    search.setAttribute('type','submit');
    search.style.width="60px";
    search.setAttribute('id','startsearching');
    search.value="Search";
	search.name="Search";
	
	var searchbox1 = document.createElement("input");
	searchbox1.setAttribute('type','text');
	searchbox1.name="name";
    
    searchbox1.value="<?= $_GET['name'] ?>";
    searchbox1.style.visibility="hidden";
	
	formelement.appendChild(searchbox);
	formelement.appendChild(search);
	formelement.appendChild(searchbox1);
	divelement.appendChild(formelement);

	
var search11 = document.createElement("input");
    search11.setAttribute('type','text');
    search11.style.width="100px";
    search11.setAttribute('id','gobacktologin');
    
	search11.value="<?= $_GET['name']?>";
	search11.name="emailid";
	search11.style.visibility="hidden";
	var search12 = document.createElement("input");
    search12.setAttribute('type','submit');
    search12.style.width="100px";
    search12.setAttribute('id','gobacktologin');
    
	search12.value="Exit Search";
	search12.name="goback";
	
//Exiting out of the search window

	var formelement11 = document.createElement("form");
	formelement11.style.width="250px";
	formelement11.style.position="absolute";
	formelement11.style.top="50px";
	formelement11.style.left="20px";
    formelement11.setAttribute('action','login.php');
    formelement11.setAttribute('method','GET');
    formelement11.setAttribute('enctype','multipart/form-data');
    formelement11.appendChild(search11);
    formelement11.appendChild(search12);
var gettingelement=document.getElementById("listings");

divelement.appendChild(formelement11);	





		

<?php
//Displaying the other users with the entered first name 
if(isset($_GET['FirstName']))

{  
?>
	var listelement = document.createElement("div");
	listelement.style.width="500px";
	listelement.style.height="500px";
	listelement.style.border="solid";
	listelement.style.position="absolute";
	listelement.style.top="90px";
	listelement.style.left="20px";
	listelement.setAttribute('id','listings');

divelement.appendChild(listelement);
<?php
$link=mysql_connect('localhost','project','mypassword')or die("could not connect:");
mysql_select_db('chat') ;
$querystring=$_GET['name'];
$query='select * from users where email not in (select friend from friends where user="'.$querystring.'") and email not in (select email from users where email="'.$querystring.'")';
$result = mysql_query($query);
$one=0;

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
{

	if($row['fname']==$_GET['FirstName'])
	{
		$one=1;
	?>
	listelement.innerHTML += "<form action=\"login.php\" method=\"GET\" ><div id=\"friendsadding\" style=\"vertical-align: middle; padding: 5px 10px 5px 10px\"><h4 id=\"<?= $row['email']?>\" style=\"vertical-align: middle; display: inline\"><?= $_GET['FirstName']?>&nbsp; <?= $row['lname']?> &nbsp;&nbsp; <small>(<?= $row['email']?> )</small></h4><input type=\"text\" name=\"emailidadd\" value=\"<?= $row['email']?>\" hidden> <button id=\"<?= $row['fname']?>&nbsp;&nbsp;<?= $row['lname']?>\" style=\"vertical-align: middle; position: absolute; right: 10px; \" class=\"btn btn-primary btn-xs\" name=\"buttonadd\"  onclick=\"f1()\">Add</button><input type=\"text\" name=\"emailid\" value=\"<?= $_GET['name']?>\" hidden></div></form>"

listelement.innerHTML += "<hr>";

$("button").click(function() {

var parentname=document.getElementById($(this).attr('id')).parentNode;
var name= parentname.getAttribute('id');
if(name=="friendsadding"){

}


});


	<?php
	} 
}
}
?>


})

//Disabling other functionalities until search is exited
$(document).click(function(e) {
var i=0; 

    		var nodes=document.getElementById("outer").childNodes;

var id1=e.target.id;
var temp1=$("#"+id1);
for(i=0;i<nodes.length;i=i+1){
    		if (e.target==nodes[i] ) {

        alert("Exit search before doing any thing");

    }


}
	if (e.target.id=="outer" ) {

        alert("Exit search before doing any thing");

    }

    if (e.target.id=="outer1" ) {

        alert("Exit search before doing any thing");

    }
});

//Adjusting the display of the user's search page
var divdimensions=document.getElementsByTagName("div")[0];
divdimensions.style.position="absolute";
divdimensions.style.width="20%";
divdimensions.style.height="100%";
divdimensions.style.left="0%";
divdimensions.setAttribute('id','outer');
divdimensions.style.top="0";


var divdimensions1=document.getElementsByTagName("div")[1];


divdimensions1.style.position="absolute";
divdimensions1.style.left="20%";
divdimensions1.style.height="100%";
divdimensions1.style.width="80%";
divdimensions1.style.top="0";
divdimensions1.setAttribute('id','outer1');


setInterval (loadonline, 2500);


//Function to check the online status of user's friends
function loadonline(){
  
  <?php $querystring=$_GET['name']; ?>
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
</body>

</html>