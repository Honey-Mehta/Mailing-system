<?php
session_start();
$email=$_SESSION['useremail'];
if(strlen($_SESSION['useremail'])=="")
{
  header('location:logout.php');
} else {

?>
<?php
// include Function  file
include_once('function.php');
// Object creation
$userdata=new DB_con();
if(isset($_POST['submit']))
{
// Posted Values
$from=$_POST['froom'];
$to=$_POST['too'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$date=$_POST['Date'];
//Function Calling
$ret=$userdata->email($to);
$num=mysqli_fetch_array($ret);
if ($num > 0) {
	$userdata->compose($from,$to,$subject,$message,$date);
  	  
	  
	   ?>
	   <script>
	   alert("succesfull");
	   </script>
	   <?php
	    header("Location:inbox.php");
	 
  	}
  	else{
       ?>
	   <script>
       alert ("Please verify email,the email is not registered with account" )  ;
	   </script>
	   <?php
  	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assests/mystyle.css">
</head>
<body><!-----------------Body of the web Page----------->

<div class="sidenav"><!-------------------------Div for side Bar------------>
  <a href="#">Compose</a>
  <a href="inbox.php">Inbox</a>
  <a href="sent.php">sent</a>
  <a href="logout.php">Logout</a>
</div><!-----------------Div for side Bar End Here-------------------->

<div class="main"><!-------------------------main Content section Starts from here------------>
  <h6>Welcome : <?php  echo  $email; ?></h6>
  <form method="POST"><!---------------HTML form for mail Compose Form Starts from here---------------->
  <table>
    <input type="hidden" name="froom" value="<?php  echo  $email; ?>">
    <tr>
	<td><label>To</label></td>
    <td><input type="email" name="too" autocomplete="on" multiple></td></tr><br>
	<tr>
    <td><label>Subject</label></td>
    <td><input type="text" name="subject"></td></tr><br>
	<tr>
	<td>
    <label>message</label>
	</td>
    <td><textarea rows="4" cols="50" name="message">
    </textarea></td></tr><br>
	<tr>
	<td>
	</td>
	<td>
	  <input type="hidden"  name="Date" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date("F j, Y, g:i a");?>"/>
	</td>

	<tr>
	
	
	
	
	
	
    <tr>
    <td>
	</td>
	<tr>
    <td>
    <button  type="submit" id="submit" name="submit" >Send</button></td></tr>
    </form><!---------------HTML form for mail Compose Form Ends  here---------------->
 </div><!-------------------------main Content section Ends  here------------>
</body><!-----------------------Body Ends Here------------------------>



</html> 
<?php } ?>





