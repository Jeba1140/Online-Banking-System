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
   $error="Hai";
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") 
	 {
		$accSearch=$_POST["AccountSearch"];
		
		$sql="SELECT * FROM user_details WHERE accountNo='$accSearch'";
		$result=mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
		
		if($count == 1) 
		{
         $_SESSION["UserAccSearch"] = $accSearch;
		 if (isset($_POST['view']))
		 {
			header("location: Viewprofile.php"); 
		 }
		 else if(isset($_POST['update']))
		 {
			 header("location: EditDetails.php"); 
		 }
		 else if(isset($_POST['transaction']))
		 {
			 header("location: TransactionDetails.php"); 
		 }
       }
	    else 
	    {
         $error = "Account not found";
        }
	 }
?>
  
		
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
			
		   </form><br> <center><span><?php echo "$error";?></span></center>
		
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
