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
   $servername="localhost";
   $username="root";
   $password="";
   $dbname="online_banking";
   $conn=mysqli_connect($servername,$username,$password,$dbname);
   
   $sql1="SELECT * FROM account WHERE accountNum=".$_SESSION["UserAccSearch"];
   $result1=mysqli_query($conn,$sql1);
   $row1=mysqli_fetch_array($result1);
   $currAmt=$row1['amount'];
   $depositInfo="";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		date_default_timezone_set('Asia/Kolkata');
		$ddate=date("Y-m-d");
		$dtime=date("H:i:s");
	     $depositAmt=$_POST["deposit_money"];	
		 if($depositAmt>=100)
		 {
			 $currAmt=$currAmt+$depositAmt;
			 $sql="UPDATE account SET amount='$currAmt' WHERE accountNum=".$_SESSION["UserAccSearch"];
			 mysqli_query($conn,$sql);
			 
			 $sql2="INSERT INTO deposit_history(accountNumber,amountDeposited,ddate,dtime) VALUES ('".$_SESSION["UserAccSearch"]."', '".$depositAmt."','".$ddate."','".$dtime."')";
			 mysqli_query($conn,$sql2);
			 
			 $depositInfo="Amount deposited";
		 }
		 else
		 {
			 $depositInfo="Invalid amount";
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
         <li><a href="Viewusers.php">All users</a></li>
         <li style="background-color: #5379fa"><a href="PaymentRequest.php">Payment Request</a></li>
         <li><a href="Withdrawl.php">Withdrawl</a></li>
         <li><a href="AdminLogin.php">Logout</a></li>
         </ul><br><br>
		 <form method="POST">
		        <span style="margin-left:35%">Current Money: </span><input type="text" name="current_money" value="<?php echo $currAmt;?>" ><br><br>	
				<span style="margin-left:35%">Deposit Money: </span><input type="text" name="deposit_money"><br><br>				
				<center><input type="submit" value="Deposit"></center>
				<br><br>
				<center><span style="color:red"><?php echo $depositInfo;?></span></center>
		  </form>
		</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
