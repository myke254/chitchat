<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
	$user_id = $user_data['id'];
	$sql = "SELECT * FROM chats";
	$message = mysqli_query($con,$sql);	

?>

<!DOCTYPE html>
<html>

<head>
	<title>chitchat</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">  
</script>  

	<style>
      
	  .contain {
		  width: 600px;
  height:400px;
  overflow-y: scroll;
  overflow-x: hidden;
}
   </style> 


</head>

<body class="bg-light">


	
    <div class="row align-items-center h-100">   
	
    <div class="col-6 mx-auto mt-3">   
	<a href="logout.php" class="float-right btn btn-primary mt-1 justify-content-center">SignOut </a>
	<div id="refresh"></div>
  <div id="time">
    <?php echo date('H:i:s');?>
  </div>

    <article class="card-body">
	
		<b> Hello, <?php echo $user_data['username']; ?></b>
		<h2>welcome to chitchat</h2>
		
		<br>
		

		<div class="contain" id="scroll_container">
		
		<?php 
		if($message)
		{
			while ($row = mysqli_fetch_assoc($message)) {
				if ($row['id']== $user_data['id']) {

					$from ="me";
					$row_class ="row justify-content-end";
					$background_class= "text-dark alert-light";

				}else{
					$from = $row['from_user'];
					$row_class ="row justify-content-start";
					$background_class= "alert-success";
				}
				
				echo '
				
				<div id="chats" class="'.$row_class.'">
				<div class="col-sm-5">
				<div class="shadow-sm alert '.$background_class.'">
				<b>'.$from.'-</b>'.$row["message"].'
				<br />
				<div class="text-right">
				<small><i>'.$row["date"].'</i></small>
				</div>
				</div>
				</div>
				</div> ';
				
				
		}
		}
		 ?>
		 
		</div>

	</article>



	 <div class="container"  style="width: 600px;">

<fieldset>
  
  <form name="frmContact" class="needs-validation " method="post" action="contact.php">
   
    <p>
      <textarea name="message" class="form-control"  id="txtMessage"  placeholder="type here" required></textarea>
    </p>
    
    <p>
      <input type="submit" name="Submit" id="Submit" value="send"  class="btn btn-primary btn-lg btn-block">
    </p>
  </form>
</fieldset>

</div>
 </div> 
    </div>
	<script type="text/javascript">
	var objDiv = document.getElementById("scroll_container");
	objDiv.scrollTop = objDiv.scrollHeight;

	setInterval("my_function();",1000); 
    function my_function(){
      //$('#2').load(location.href + ' #chats');
	  
    }

  function validation()  
  {  
      var id=document.f1.message.value;   
      if(id.length=="") {  
          alert("messagebox is empty");  
          return false;  
      }                         
  }  
  
</script> 
</body>



</html>