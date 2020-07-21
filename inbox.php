<?php
session_start();
$email=$_SESSION['useremail'];
if($email==true)
{
	 
}
else
{
header("Location:signin.php");
}
?>

<?php
// include Function  file
include_once('function.php');
// Object creation
$fetchdata=new DB_con();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<title>Inbox</title>
	
	<link rel="stylesheet" type="text/css" href="assests/mystyle.css">
	

	<style>
	table {
	  font-family: arial, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

	tr:nth-child(even) {
	  background-color: #dddddd;
	}
	   td, a {
		   text-decoration:none;
	   }
    
     </style>
</head>



<body><!---------------body starts from here-------------------->

<div class="sidenav"><!---------------------div For sidebar starts from here--------------------->
  <a href="compose.php">Compose</a>
  <a href="#">Inbox</a>
  <a href="sent.php">sent</a>
  <a href="logout.php">Logout</a>
</div><!---------------------div For sidebar Ends here--------------------->




<div class="main"><!---------------------div For main content  Starts here--------------------->
<h2 Style="text-align:center;">Inbox</h2>
<h6>Welcome :   <?php  echo  $_SESSION['useremail'];?></h6>
    <table width="600" border="1" cellpadding="1" cellspacing="1" style="margin:auto;" id="myTable">
		<tr>
		<th><input type="checkbox" id="checkAll"></th>
			<th>From</th>
            <th>subject</th>
			<th>Date</th>
         </tr>
        <?php
         
		 $sql=$fetchdata->inbox($email);
        while($row=mysqli_fetch_assoc($sql))
        {
         $reply_id=$row['reply_id'];
		  $id     =   $row['id'];
		  $date =$row['Date'];
         ?>
		
		<tr>
		    <td><input class="checkbox" type="checkbox" id="<?php echo $row['id']; ?>" name="id[]"></td>
		    <td><a href="mail_message.php?id=<?php if($reply_id=="0"){echo $id; } else {echo $reply_id;}?>"><?php echo $row['froom']; ?></a></td>
		    
		    <td style="width:400px;"><a href="mail_message.php?id=<?php if($reply_id=="0"){echo $id; } else {echo $reply_id;}?>"><?php echo substr($row['subject'],0,10); ?></a></td>
			<td><a href="mail_message.php?id=<?php if($reply_id=="0"){echo $id; } else {echo $reply_id;}?>"><?php echo $date; ?></a></td>
		</tr>
		<?php } ?>
   </table>
   <br/>
   <button type="button" class="btn btn-danger" id="delete">Delete Selected</button>
</div><!---------------------div For main content  ends here--------------------->
	
	<script>
	$(document).ready(function(){
		$('#checkAll').click(function(){
			if(this.checked){
				$('.checkbox').each(function(){
					this.checked = true;
				});
			}else{
				$('.checkbox').each(function(){
					
					this.checked = false;
				});
			}
		});
		
		$('#delete').click(function(){
			var dataArr = new Array();
			if($('input:checkbox:checked').length>0){
			  $('input:checkbox:checked').each(function(){
			  dataArr.push($(this).attr('id'));
			  $(this).closest('tr').remove();
			  });
			  sendResponse(dataArr);
			}else{
				
				alert("No record Selected");
			}
			
			});
			function sendResponse(dataArr){
				$.ajax({
					type: 'post',
					url:  'delete.php',
					data :{'data': dataArr},
					  success : function(response)
					  {
						  alert(response);
						  
					  },
					  error : function(errResponse)
					  {
						  alert(errResponse);
					  }
				});
			}
	});
	</script>
</body><!---------------body Ends  here-------------------->


</html>

