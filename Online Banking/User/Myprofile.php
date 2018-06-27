<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>User Profile</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>

<body>
  <?php
   session_start();
   $servername="localhost";
   $username="root";
   $password="";
   $dbname="online_banking";
   $fName=$lName=$gender=$age=$address=$district=$state=$email=$mobileNo=$accountNo="";
   
   $conn=mysqli_connect($servername,$username,$password,$dbname);
   if(!$conn)
   {
	 die("Connection failed:".mysqli_connect_error());
   }
   else
   {
	   $sqlQuery = "SELECT firstName,lastName,gender,age,address,district,state,email,mobileNo,accountNo FROM user_details WHERE accountNo=".$_SESSION['AccountNo'];
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
			<div style="margin-left:90%;margin-top:-8%;width:45%;font-size:20px;background-color:blue">
			   <?php echo "Account Number:".$_SESSION['AccountNo'];?><br>
			   <?php echo "User name:".$_SESSION['Username1']." ".$_SESSION['Username2'];?>
			</div>
		</div>
		<div class="Myprofile">
				<ul>
         <li style="background-color: #5379fa"><a href="Myprofile.php">My Profile</a></li>
         <li><a href="Transaction.php">Transaction</a></li>
         <li><a href="Deposit.php">Deposit</a></li>
		 <li><a href="AccountStatement.php">Account Statement</a></li>
         <li><a href="logout.php">Logout</a></li>
         </ul>
				<a href="Editprofile.php" style="text-decoration:none"><input type="button" value="Edit profile"></a>
				<br><br>
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
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
