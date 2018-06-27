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
   
   $sql1="SELECT * FROM account WHERE accountNum=".$_SESSION['AccountNo'];
   $result1=mysqli_query($conn,$sql1);
   $row1=mysqli_fetch_array($result1);
   $currAmt=$row1['amount'];
   
  ?>
  <div class="body4"></div>
		<div class="grad"></div>
		<div class="header4">
			<div>Online<span> Banking</span> System</div>
			<div style="margin-left:90%;margin-top:-8%;width:45%;font-size:20px;background-color:blue">
			   <?php echo "Account Number:".$_SESSION['AccountNo'];?><br>
			   <?php echo "User name:".$_SESSION['Username1']." ".$_SESSION['Username2'];?>
			</div>
		</div>
		<div class="Deposit">
				<ul>
         <li><a href="Myprofile.php">My Profile</a></li>
         <li><a href="Transaction.php">Transaction</a></li>
         <li style="background-color: #5379fa"><a href="Deposit.php">Deposit</a></li>
		 <li><a href="AccountStatement.php">Account Statement</a></li>
         <li><a href="Login.php">Logout</a></li>
         </ul><br><br>
		  <form method="POST">
		        <span style="margin-left:35%">Current Money: </span><input type="text" name="current_money" value="<?php echo $currAmt;?>" ><br><br>	
				<span style="margin-left:35%">Deposit Money: </span><input type="text" name="deposit_money"><br><br>				
				<center><input type="submit" value="Deposit"></center>
		  </form>
		</div>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
