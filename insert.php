<?php
 include"config.php";

 $firstname=$_POST['firstname'];
 $lastname=$_POST['lastname'];
 $country=$_POST['country'];
 $subject=$_POST['subject'];
 
 $sql=mysqli_query($con,"INSERT INTO users (firstname,lastname,country,subject) values ('$firstname','$lastname','$country','$subject')");

 if($sql)
 {
	 echo"registation successfull";

	 header("Location:view.php");
 }
 else{
	 echo"registration not successfull";
 }
 
?>