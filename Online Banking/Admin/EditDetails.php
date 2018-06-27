<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Edit Profile</title>
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
   
    $fName=$lName=$gender=$age=$address=$district=$state=$email=$mobileNo=$accountNo=$pass="";
    $fName2=$lName2=$gender2=$age2=$address2=$district2=$state2=$email2=$mobileNo2=$accountNo2=$pass2="";
    $updation="";
	
	$conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn)
    {
	 die("Connection failed:".mysqli_connect_error());
    }
	else
   {
	   $sqlQuery = "SELECT firstName,lastName,age,address,district,state,email,mobileNo,accountNo,Password FROM user_details WHERE accountNo=".$_SESSION["UserAccSearch"];
	   $result=mysqli_query($conn, $sqlQuery);
	   $count=0;
	   while($row=mysqli_fetch_array($result))
	   {
		   $fName=$row['firstName'];
		   $lName=$row['lastName'];
		   $age=$row['age'];
		   $address=$row['address'];
		   $district=$row['district'];
		   $state=$row['state'];
		   $email=$row['email'];
		   $mobileNo=$row['mobileNo'];
		   $accountNo=$row['accountNo'];
		   $pass=$row['Password'];
	   }
   }
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") 
   {
		$fName2 = test_input($_POST["ufname"]);
		$lName2 = test_input($_POST["ulname"]);
		$gender2 =test_input($_POST["ugender"]);
		$age2 = test_input($_POST["uage"]);
		$address2 = test_input($_POST["uaddress"]);
		$district2 = test_input($_POST["udistrict"]);
		$state2 = test_input($_POST["ustate"]);
		$email2 = test_input($_POST["umail"]);
		$mobileNo2 = test_input($_POST["umobile"]);
		$accountNo2= test_input($_POST["uaccountno"]);
		$pass2= test_input($_POST["upassword"]);
   
   if (isset($_POST['submit1']))
	 {
		 $sql="UPDATE user_details SET firstName='$fName2', lastName='$lName2', gender='$gender2',age='$age2',address='$address2',district='$district2',state='$state2',email='$email2', mobileNo='$mobileNo2', Password='$pass2' WHERE accountNo=".$_SESSION["UserAccSearch"];
		//$sql="UPDATE user_details SET firstName='$fName2', lastName='$lName2', gender='$gender2', age='$age2' address='$address2', district='$district2', state='$state2', email='$email2', mobileNo='$mobileNo2', accountNo='$accountNo2', Password='$pass2' WHERE accountNo=".$_SESSION['AccountNo'];
		$result = mysqli_query($conn,$sql);
		
		$updation="*Information updated";
	 }
   }
     function test_input($data) 
	 {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	 }	 
?>
  <div class="body2"></div>
		<div class="grad"></div>
		<div class="header2">
			<div>Online<span> Banking</span> System</div>
		</div>
		<div class="Viewprofile"style="height: 100%;">
				<ul>
         <li style="background-color: #5379fa"><a href="Viewusers.php">All users</a></li>
         <li><a href="PaymentRequest.php">Payment Request</a></li>
         <li><a href="Withdrawl.php">Withdrawl</a></li>
         <li><a href="AdminLogin.php">Logout</a></li>
         </ul>
		 <span id="span1" style="margin-left:43%"><u>Edit Details</u></span><br><br>
		 <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<span style="margin-left:35%">First Name </span><input type="text" name="ufname" value="<?php echo $fName;?>">
				<br><br>
				
				<span style="margin-left:35%">Last Name </span><input type="text" name="ulname" value="<?php echo $lName;?>">
				<br><br>
				
				<span style="margin-left:37%">Gender </span>
					<input type="radio" name="ugender" value="male"> Male
					<input type="radio" name="ugender" value="female"> Female
					<input type="radio" name="ugender" value="other"> Other
					<br><br>
				
				<span style="margin-left:39%">Age </span><input type="text" name="uage" value="<?php echo $age;?>">
				<br><br>
				
				<span style="margin-left:36%">Address </span><input type="text" name="uaddress" value="<?php echo $address;?>">
				<br><br>
				
				<span style="margin-left:36%">District </span>
				<select name="udistrict" value="<?php echo $district;?>">
				       <option value="Tirunelveli">Tirunelveli</option>
					   <option value="Tiruppur">Tiruppur</option>
					   <option value="Kanyakumari">Kanyakumari</option>
					   <option value="Madurai">Madurai</option>
					   <option value="Vellore">Vellore</option>
					   <option value="Coimbatore">Coimbatore</option>
					   <option value="Chennai">Chennai</option>
					   <option value="Others">Others</option>
				 </select>
				<br><br>  
				
				<span style="margin-left:38%">State</span> <select name="ustate" value="<?php echo $state;?>">
					   <option value="Tamilnadu">Tamilnadu</option>
				      </select>
				  <br><br>
				
				<span style="margin-left:37%">Email </span><input type="text" name="umail" value="<?php echo $email;?>">
				<br><br>
				
				<span style="margin-left:34%">Mobile no </span><input type="text" name="umobile" value="<?php echo $mobileNo;?>"> 
                <br><br>
				
				<span style="margin-left:33%">Account no </span><input type="text" name="uaccountno" value="<?php echo $accountNo;?>">
				<br><br>
				
				<span style="margin-left:37%">Password </span><input type="password" name="upassword" value="<?php echo $pass;?>">
				<br><br>
				
				<input type="submit" value="Update" style="margin-left:45%" name="submit1">
				<span style="color:red"> <?php echo $updation;?></span><br><br>
			</form>
		</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
