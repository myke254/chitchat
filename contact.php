<?php 
session_start();
// database connection code
if(isset($_POST['message']))
{
$conn = mysqli_connect('localhost', 'root', '','mydatabase');

// get the post records
$message_data = $_POST['message'];
$userName = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];
$date_time = date("Y-m-d");

// database insert SQL code
$sql = "INSERT INTO chats (chat_id,id,message,date,from_user) VALUES ('','$user_id','$message_data','$date_time','$userName')";

// insert in database 
$rs = mysqli_query($conn, $sql);
if($rs)
{
    header("Location: index.php");
	die;
}
}
else
{
    header("Location: index.php");
    die;
	//echo "Are you a genuine visitor?";
	
}
?>
