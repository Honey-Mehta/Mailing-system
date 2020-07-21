<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Ajax</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>View data</h2>
	<table class="table table-bordered table-sm" >

      <tr>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Country</td>
		<td>Subject</td>
      </tr>
    
    
      <?php
	include 'config.php';
	$sql=mysqli_query($con,"SELECT * from users");
	
	
		 while($row=mysqli_fetch_assoc($sql)){
			 $firstname=$row['firstname'];
			  $lastname=$row['lastname'];
			   $country=$row['country'];
			    $subject=$row['subject'];
?>	
             
		<tr id="table">
			<td><?php echo $firstname ;?></td>
			<td><?php echo $lastname ;?></td>
			<td><?php echo $country;?></td>
			<td><?php echo $subject;?></td>
		</tr>
<?php	
	}
	
?>
    </tbody>
  </table>
</div>
<script>
	$.ajax({
		
		type: "POST",
		
		success: function(data){
			alert(data);
			$('#table').html(data); 
		}
	});
</script>
</body>
</html>