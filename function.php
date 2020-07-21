<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'userdb');
class DB_con
{
function __construct()
{
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$this->dbh=$con;
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
}

// for username availblty
public function useremailavailblty($uemail) {
$result =mysqli_query($this->dbh,"SELECT UserEmail FROM tblusers WHERE UserEmail='$uemail'");
return $result;
}

// Function for registration
	public function registration($fname,$uname,$uemail,$pasword)
	{
	$ret=mysqli_query($this->dbh,"insert into tblusers(FullName,Username,UserEmail,Password) values('$fname','$uname','$uemail','$pasword')");
	return $ret;
	}

// Function for signin
public function signin($uemail,$pasword)
	{
	$result=mysqli_query($this->dbh,"select UserEmail,Password from tblusers where UserEmail='$uemail' and Password='$pasword'");
	return $result;
	}

// Function for compose
	public function compose($from,$to,$subject,$message,$date)
	{
	$ret=mysqli_query($this->dbh,"insert into compose(froom,too,subject,message,Date) values('$from','$to','$subject','$message','$date')");
	return $ret;
	}
// Function for sentbox
  public function sentbox($email)
  {
	$result=mysqli_query($this->dbh,"select * from compose where froom='$email' ORDER BY id DESC ")  ;
	 return $result;
  }
  // Function for inbox data
  public function inbox($email)
  { 
   
	$result=mysqli_query($this->dbh,"select  * from compose where too='$email'    ORDER BY id DESC" )  ;
	 return $result;
  }
  
  // Function for verify email
public function email($to)
	{
	$result=mysqli_query($this->dbh,"SELECT * FROM tblusers WHERE UserEmail='$to'");
	return $result;
	}
  
  //function message detail
  public function messagedetail($id)
  {
	$result=mysqli_query($this->dbh,"SELECT * FROM `compose` WHERE  id='$id' or reply_id='$id' ORDER BY id DESC ");
	return $result;
	}
	
	
	//function message detail
  public function getmailreply($id)
  {
	$result=mysqli_query($this->dbh,"SELECT * FROM `compose` WHERE   reply_id='$id' ORDER BY id DESC");
	return $result;
	}
  
  //Reply mail detail
    public function mailreply($reply_id,$email,$to,$subject,$message,$date)
    {
		$result=mysqli_query($this->dbh,"insert into compose(reply_id,froom,too,subject,message,Date) values('$reply_id','$email','$to','$subject','$message','$date')");
		return $result;
		
	}
  
  
}
?>