<?php
$connection =mysqli_connect('localhost','root','','userdb');

if(isset($_POST['data']))
{
  $dataArr =$_POST['data'];
  foreach($dataArr as $id){
	  mysqli_query($connection,"DELETE FROM compose where id='$id'");
  }
  echo "Record Deleted successfully";
  }
?>