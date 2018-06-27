<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Online Banking System</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>

<body id="body1">
  <?php
     session_start();
	 if(isset($_SESSION["AdminID"]))
     {
	   unset($_SESSION["AdminID"]);
     }
     $servername="localhost";
	 $username="root";
     $password="";
     $dbname="online_banking";
	 $conn=mysqli_connect($servername,$username,$password,$dbname);
	 $error="";
	 
	 if ($_SERVER["REQUEST_METHOD"] == "POST") 
	 {
		$id=$_POST["AdminID"];
		$password=$_POST["AdminPassword"];
		
		$sql="SELECT * FROM admin WHERE admin_id='$id' and admin_pass='$password'";
		$result=mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
		
		if($count == 1) 
		{
         $_SESSION["AdminID"] = $id;
         
         header("location: Viewusers.php");
       }
	    else 
	    {
         $error = "You are not an admin";
        }
	 }
  ?>
  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Online<span>Banking</span></div>
		</div>
		<br>
		<div class="login">
		  <form method="POST">
				<input type="text" placeholder="Admin ID" name="AdminID"><br>
				<input type="password" placeholder="Password" name="AdminPassword"><br>
				<span style="margin-left:30%"><input type="submit" value="Login" onclick=""></span>
		  </form><br> <span style="color:white"><?php echo "$error";?></span>
		</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
