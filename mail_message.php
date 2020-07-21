<?php
session_start();
$email=$_SESSION['useremail'];
?>





<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inbox</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assests/mystyle.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<style>
				
				/* css for table */
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
				
				
			
         



         body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button{
	
	height:40px;
	font-size:20px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text] ,.form-container input[type=email] {
  width: 100%;
  padding: 10px;
  height:30px;
  font-size:20px;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}			
	textarea{			
 background: #f1f1f1;				
				
	}				
				
				
				
			
	</style>
</head>
<body>
<div class="sidenav"><!--------------side bar div starts from here------------------>
  <a href="compose.php">Compose</a>
  <a href="inbox.php">Inbox</a>
  <a href="sent.php">sent</a>
  <a href="logout.php">Logout</a>
</div><!--------------side bar div starts from here------------------>


<div class="main">
<h3 style="text-align:center;">Message Detail</h3>
	<table width="600" border="1" cellpadding="1" cellspacing="1" style="margin:auto;">
	
       
<?php
// include Function  file
include_once('function.php');
// Object creation
$messagedata=new DB_con();
     if (isset($_GET['id'])) {
     $id = $_GET['id'];
	
     $res=$messagedata->getmailreply($id);
     $res=$messagedata->messagedetail($id);
     while ($row1 = mysqli_fetch_array($res)) {
            $from=$row1['froom'];
		    $reply_id=$row1['reply_id'];
			$to=$row1['too'];
			$subject=$row1['subject'];
			$message=$row1['message'];
			$date=$row1['Date'];
        ?>
		<tr>
		    <td>From</td>
			<td><?php echo $from; ?></td>
		</tr>
		
		<tr>
		    <td>To</td>
			<td><?php echo $to; ?></td>
	    </tr>
		
		<tr>
			<td>Subject</td>
			<td><?php echo $subject; ?></td>
		</tr>
		
		<tr>
			<td>Message</td>
		     <td><?php echo $message;  ?></td>
		</tr>	
		
		<tr>
			<td>Date</td>
		     <td><?php echo $date;  ?></td>
		</tr>	
		
	   
	    <tr>
		
		<td>
		<button class="open-button btn-success" onclick="openForm()">REPLY</button>
         </td>
		 <td>
		 </td>
		
		</tr>
		 
		 <tr>
		 
		 <td>
		 <hr/>
		 </td>
		 <td>
		 <hr/ style="border:collapse;">
		 </td>
		 
		 
        </tr>
             
 
      
	
		
		
<?php }} ?>
		
    </table>
	
	
	
	
	
	<div class="form-popup" id="myForm">
  <form  method="post" class="form-container">
    <h6>Reply</h6>
	<input type="hidden"  name="reply_id"  value="<?php  if($reply_id=="0"){echo $id; } else {echo $reply_id;} ?>" required>
    <input type="hidden"  name="froom"  value="<?php echo $email;?>" required>
	<input type="hidden"  name="subject" value="<?php echo $subject; ?>" required>
	

	
    <label for="email"><b>To</b></label>
    <input type="text" placeholder="Enter Email" name="too" value=""  required>

      <label for="textarea">Message</label>
    <textarea rows="2" cols="18" id="textarea" name="message" >
    </textarea>
   <input type="hidden"  name="Date" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date("F j, Y, g:i a");?>"/>

      <button type="submit" class="btn" name="reply">Reply</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>
	
	
	<!----popup form-------------->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<!---------------------------------php code for reply form starts from here--------------------->	
<?php
//php code for reply form
include_once('function.php');
// Object creation
$messagedata=new DB_con();
if(isset($_POST['reply']))
{
// Posted Values
$reply_id=$_POST['reply_id'];
$email=$_POST['froom'];
$to=$_POST['too'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$date=$_POST['Date'];
//Function Calling
$sql=$messagedata->mailreply($reply_id,$email,$to,$subject,$message,$date);
if($sql)
{
?>
<script>
alert("Reply Successfull");
</script>
<?php
}
else
{
?>
<script>
alert("Reply not Successfull");
</script>
<?php
}
}
?>
<!---------------------------------php code for reply form ends here--------------------->		
	







<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
</body>
</html>

