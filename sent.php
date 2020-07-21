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
$fetchdata=new DB_con();

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assests/mystyle.css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>	
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
<body>

<div class="sidenav">
  <a href="compose.php">Compose</a>
  <a href="inbox.php">Inbox</a>
  <a href="#">sent</a>
  <a href="logout.php">Logout</a>
</div>

<div class="main">
<h2 Style="text-align:center;">Sent Items</h2>
  <h6>Welcome : <?php  echo  $_SESSION['useremail'];?></h6>
  <table width="600" border="1" cellpadding="1" cellspacing="1" style="margin:auto;">
		<tr>
		<th><input type="checkbox" id="checkAll"></th>
			<th>TO</th>
            <th>Subject</th>
            <th>Date</th>
        </tr>
        <?php
		$sql=$fetchdata->sentbox($email);
        while($row=mysqli_fetch_assoc($sql))
        {
          $reply_id=$row['reply_id'];
		  $id     =   $row['id'];
        	  $date =$row['Date'];
        ?>
		<tr>
		 <td><input class="checkbox" type="checkbox" id="<?php echo $row['id']; ?>" name="id[]"></td>
		   <td><a href="mail_message.php?id=<?php if($reply_id=="0"){echo $id; } else {echo $reply_id;}?>"><?php echo $row['too']; ?></td>
		    
		    <td style="width:400px;"><a href="mail_message.php?id=<?php if($reply_id=="0"){echo $id; } else {echo $reply_id;}?>"><?php echo substr($row['subject'],0,15); ?></td>
			<td><a href="mail_message.php?id=<?php if($reply_id=="0"){echo $id; } else {echo $reply_id;}?>"><?php echo $date; ?></a></td>
		</tr>
		<?php } ?>
    </table>
	  <br/>
   <button type="button" class="btn btn-danger" id="delete">Delete Selected</button>
</div>

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
     
</body>
</html> 





<?php } ?>