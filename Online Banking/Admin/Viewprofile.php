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
	 $var=$_SESSION["UserAccSearch"];
     $servername="localhost";
	 $username="root";
     $password="";
     $dbname="online_banking";
	 $conn=mysqli_connect($servername,$username,$password,$dbname);
	 $fName=$lName=$gender=$age=$address=$district=$state=$email=$mobileNo=$accountNo="";
	 if(!$conn)
     {
	   die("Connection failed:".mysqli_connect_error());
     }
     else
     {
		$sqlQuery = "SELECT firstName,lastName,gender,age,address,district,state,email,mobileNo,accountNo FROM user_details WHERE accountNo=".$_SESSION["UserAccSearch"];
	    $result=mysqli_query($conn, $sqlQuery);
	   
	    while($row=mysqli_fetch_array($result))
	    {
		   $fName=$row['firstName'];
		   $lName=$row['lastName'];
		   $gender=$row['gender'];
		   $age=$row['age'];
		   $address=$row['address'];
		   $district=$row['district'];
		   $state=$row['state'];
		   $email=$row['email'];
		   $mobileNo=$row['mobileNo'];
		   $accountNo=$row['accountNo'];
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
		 <span id="span1" style="margin-left:43%"><u>User Profile</u></span><br><br>
		 
		 <center>
			   <table border="1">
			     <tr><th>First Name</th><td><?php echo $fName ?></td><tr>
				 <tr><th>Last Name</th><td><?php echo $lName ?></td><tr>
				 <tr><th>Gender</th><td><?php echo $gender ?></td><tr>
				 <tr><th>Age</th><td><?php echo $age ?></td><tr>
				 <tr><th>Address</th><td><?php echo $address?></td><tr>
				 <tr><th>District</th><td><?php echo $district ?></td><tr>
				 <tr><th>State</th><td><?php echo $state ?></td><tr>
				 <tr><th>Email</th><td><?php echo $email ?></td><tr>
				 <tr><th>Mobile Number</th><td><?php echo $mobileNo ?></td><tr>
				 <tr><th>Account Number</th><td><?php echo $accountNo ?></td><tr>
			   </table>
			</center>
		</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
