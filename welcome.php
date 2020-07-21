<?php
session_start();
if(strlen($_SESSION['useremail'])=="")
{
  header('location:logout.php');
} else {

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assests/mystyle.css">

</head>
<body>

<div class="sidenav">
   
  <a href="compose.php">Compose</a>
  <a href="inbox.php">Inbox</a>
  <a href="sent.php">sent</a>
  <a href="logout.php">Logout</a>
</div>

<div class="main">
  <h2>Welcome : <?php  echo  $_SESSION['useremail'];?></h2>
</div>

     
</body>
</html> 

<?php } ?>