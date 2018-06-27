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
	 $servername="localhost";
	 $username="root";
     $password="";
     $dbname="online_banking";
	 $conn=mysqli_connect($servername,$username,$password,$dbname);
     session_start();
	 $error="";
	 if(!$conn)
	 {
		die("Connection failed:".mysqli_connect_error());
	 }
	
	 if(isset($_SESSION["AccountNo"]))
     {
	   unset($_SESSION["AccountNo"]);
     }
	 if(isset($_SESSION["Username1"]))
     {
	   unset($_SESSION["Username1"]);
     }
	 if(isset($_SESSION["Username2"]))
     {
	   unset($_SESSION["Username2"]);
     }
	 
	 if ($_SERVER["REQUEST_METHOD"] == "POST") 
	 {
		$accNo=$_POST["uaccount"];
		$password=$_POST["upassword"];
		$capcha=$_POST["ucapcha"];
		
		$sql="SELECT * FROM user_details WHERE accountNo='$accNo' and Password='$password'";
		$result=mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
		
		if($count == 1) 
		{
			if($capcha==$_SESSION['my_captcha'])
			{
				$_SESSION["AccountNo"] = $accNo;
		        $_SESSION["Username1"] = $row["firstName"];
		        $_SESSION["Username2"] = $row["lastName"];
                header("location: Myprofile.php");
			}
			else
			{
			    $error="<span style='margin-left:20%'>Capcha validation failed</span>";
			}
       }
	    else 
	    {
         $error = "Your Account Number or Password is invalid";
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
		  <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<input type="text" placeholder="Account Number" name="uaccount"><br>
				<input type="password" placeholder="Password" name="upassword"><br><br>
				<img src=captcha.php id="capt" style="margin-left:25%">
				<input type="text" placeholder="Enter Capcha" name="ucapcha"><br><br>
				<span style="margin-left:30%"><input type="submit" value="Login"></span>
		  </form><br> <span style="color:white"><?php echo "$error";?></span><br>
		  <span style="margin-left:23%"><a href="Signup.php" style="color:white"><u>Create an account</u></a></span>
		</div>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
