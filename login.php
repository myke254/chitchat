<?php 

session_start();

	include("connection.php");
	include("functions.php");
    


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where username = '$user_name' limit 1";
            
            $result = mysqli_query($con, $query);
            
            

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['id'];
                        $_SESSION['user_name'] = $user_data['username'];
						header("Location: index.php");
						
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
      <div class="container mt-5">
        <div class="row align-items-center h-100">   
    <div class="col-6 mx-auto mt-5">
        
        
	<div class="card h-100 border-primary justify-content-center mt-5">
        <article class="card-body">
        <a href="signup.php" class="float-right btn btn-outline-primary">Sign up</a>
        <h2 class="card-title mb-4 mt-2">Sign in</h2>
             <form name="f1" onsubmit = "return validation()" method ="post">
            <div class="form-group">
                <label>Username </label>
                <input name="user_name" class="form-control mt-2 mb-2" placeholder="user_name">
            </div> <!-- form-group// -->
            <div class="form-group">
               
                <label>password</label>
                <input name = "password" class="form-control mb-2 mt-1" placeholder="******" type="password">
            </div> <!-- form-group// --> 
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block mt-2"> Login  </button>
            </div> <!-- form-group// -->                                                           
        </form>
        </article>
        </div>
<!-- card.// -->
       
        
    </div> <!-- col.// -->
    </div>
</div>
<script language = "javascript">  
  function validation()  
  {  
      var id=document.f1.user_name.value;  
      var ps=document.f1.user_pass.value;  
      if(id.length=="" && ps.length=="") {  
          alert("User Name and Password fields are empty");  
          return false;  
      }  
      else  
      {  
          if(id.length=="") {  
              alert("User Name is empty");  
              return false;  
          }   
          if (ps.length=="") {  
          alert("Password field is empty");  
          return false;  
          }  
      }                             
  }  
</script>  
  </body>
</html>