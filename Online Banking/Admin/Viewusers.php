<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>View Users</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>

<body>
<?php
   session_start();
   if(isset($_SESSION["UserAccSearch"]))
   {
	  unset($_SESSION["UserAccSearch"]);
   }
   $servername="localhost";
   $username="root";
   $password="";
   $dbname="online_banking";
   $conn=mysqli_connect($servername,$username,$password,$dbname);
   $error="";
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") 
	 {
		$accSearch=$_POST["AccountSearch"];
		
		$sql="SELECT * FROM user_details WHERE accountNo='$accSearch'";
		$result=mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
		
		if($count == 1) 
		{
		 if (isset($_POST['view']))
		 {
			$_SESSION["UserAccSearch"] = $accSearch;
			header("location: Viewprofile.php"); 
		 }
		 else if(isset($_POST['update']))
		 {
			 $_SESSION["UserAccSearch"] = $accSearch;
			 header("location: EditDetails.php"); 
		 }
		 else if(isset($_POST['transaction']))
		 {
			 $_SESSION["UserAccSearch"] = $accSearch;
			 header("location: TransactionDetails.php"); 
		 }
		 else if(isset($_POST['deposit']))
		 {
			 $_SESSION["UserAccSearch"] = $accSearch;
			 header("location: PaymentRequest.php"); 
		 }
		 else if(isset($_POST['withdrawl']))
		 {
			 $_SESSION["UserAccSearch"] = $accSearch;
			 header("location: Withdrawl.php"); 
		 }
       }
	    else 
	    {
         $error = "* Account not found";
        }
	 }
?>
  <div class="body2"></div>
		<div class="grad"></div>
		<div class="header2">
			<div>Online<span> Banking</span> System</div>
		</div>
		<div class="Viewprofile">
		<ul>
         <li style="background-color: #5379fa"><a href="Viewusers.php">All users</a></li>
         <li><a href="PaymentRequest.php">Payment Request</a></li>
         <li><a href="Withdrawl.php">Withdrawl</a></li>
         <li><a href="AdminLogin.php">Logout</a></li>
         </ul>
		 <span id="span1" style="margin-left:43%"><u>List of users</u></span><br><br>
		 <form method="POST">
			<center>Enter user account:<input type="text" name="AccountSearch"></center><br>
			<center><input type="submit" value="View Details" name="view"></center><br>
			<center><input type="submit" value="Update Details" name="update"></center><br>
			<center><input type="submit" value="Transaction Details" name="transaction"></center><br>
			<center><input type="submit" value="Deposit Money" name="deposit"></center><br>
			<center><input type="submit" value="Withdrawl Money" name="withdrawl"></center>
		   </form><br>
		   <center><span style="color:red"><?php echo "$error";?></span></center>
		</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
