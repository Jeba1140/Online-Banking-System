<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Deposit Money</title>
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
   $withdrawlInfo="";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		date_default_timezone_set('Asia/Kolkata');
		$wdate=date("Y-m-d");
		$wtime=date("H:i:s");
	     $withdrawlAmt=$_POST["Wamt"];	
		 if($currAmt>$withdrawlAmt)
		 {
			 $currAmt=$currAmt-$withdrawlAmt;
			 $sql="UPDATE account SET amount='$currAmt' WHERE accountNum=".$_SESSION["UserAccSearch"];
			 mysqli_query($conn,$sql);
			 
			 $sql2="INSERT INTO withdrawl_history(accountNumber,amountWithdrawl,wdate,wtime) VALUES ('".$_SESSION["UserAccSearch"]."', '".$withdrawlAmt."','".$wdate."','".$wtime."')";
			 mysqli_query($conn,$sql2);
			 
			 $withdrawlInfo="Amount successfully withdrawn";
		 }
		 else
		 {
			 $withdrawlInfo="Don't have enough balance to withdraw";
		 }
			 
	}
   
?>

  <div class="body4"></div>
		<div class="grad"></div>
		<div class="header4">
			<div>Online<span> Banking</span> System</div>
		</div>
		<div class="Deposit">
				<ul>
          <li><a href="Viewusers.php">All users</a></li>
         <li><a href="PaymentRequest.php">Payment Request</a></li>
         <li style="background-color: #5379fa"><a href="Withdrawl.php">Withdrawl</a></li>
         <li><a href="AdminLogin.php">Logout</a></li>
         </ul><br><br>
		  <form method="POST">
		        <span style="margin-left:35%">Account No: </span><input type="text" name="UaccNo" value="<?php echo $_SESSION["UserAccSearch"];?>"><br><br>	
				<span style="margin-left:30%">Withdrawl Amount: </span><input type="text" name="Wamt"><br><br>				
				<center><input type="submit" value="Update"></center>
				<br><br>
				<center><span style="color:red"><?php echo $withdrawlInfo;?></span></center>
		  </form>
		</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
