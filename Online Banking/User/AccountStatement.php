<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Account Statement</title>
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
         <li><a href="Myprofile.php">My Profile</a></li>
         <li><a href="Transaction.php">Transaction</a></li>
         <li><a href="Deposit.php">Deposit</a></li>
		 <li style="background-color: #5379fa"><a href="AccountStatement.php">Account Statement</a></li>
         <li><a href="Login.php">Logout</a></li>
         </ul>
		 <br>
		 <?php 
		     echo "<center><h3>Transaction Details</h3></center>";
			 $sqlQuery = "SELECT from_account,to_account,amount,tdate,ttime FROM transaction_history WHERE from_account=".$_SESSION['AccountNo'];
				$result = mysqli_query($conn, $sqlQuery);
	   
				if (($result)||(mysql_errno == 0))
				{
				  echo "<center><table border='1'><tr>";
				  echo "<th>Account Number</th><th>Transferred Account</th><th>Amount Transferred</th><th>Transferred Date</th><th>Transferred Time</th>";
				  echo "</tr>";
			 
			 	while ($rows = mysqli_fetch_array($result,MYSQL_ASSOC))
				{
			     	echo "<tr>";
				    foreach ($rows as $data)
				   {
				     echo "<td>". $data . "</td>";
				   }
				}
				}
				else
				{
					echo "<tr><td>No Transaction found!</td></tr>";
				}
				echo "</table></center>";
		 ?>
		 
		 <?php 
		     echo "<center><h3>Deposit Details</h3></center>";
			 $sqlQuery2 = "SELECT accountNumber,amountDeposited,ddate,dtime FROM deposit_history WHERE accountNumber=".$_SESSION['AccountNo'];
				$result2 = mysqli_query($conn, $sqlQuery2);
	   
				if ($result2)
				{
				  echo "<center><table border='1'><tr>";
				  echo "<th>Account Number</th><th>Deposited Amount Account</th><th>Deposited Date</th><th>Deposited Time</th>";
				  echo "</tr>";
			 
			 	while ($rows2 = mysqli_fetch_array($result2,MYSQL_ASSOC))
				{
			     	echo "<tr>";
				    foreach ($rows2 as $data2)
				   {
				     echo "<td>". $data2 . "</td>";
				   }
				}
				}
				else
				{
					echo "<tr><td>No Deposit found!</td></tr>";
				}
				echo "</table></center>";
		 ?>
		 
		 <?php 
		     echo "<center><h3>Withdrawal Details</h3></center>";
			 $sqlQuery3 = "SELECT accountNumber,amountWithdrawl,wdate,wtime FROM withdrawl_history WHERE accountNumber=".$_SESSION['AccountNo'];
				$result3 = mysqli_query($conn, $sqlQuery3);
	   
				if ($result3)
				{
				  echo "<center><table border='1'><tr>";
				  echo "<th>Account Number</th><th>Withdrawal Amount</th><th>Withdrawal Date</th><th>Withdrawal Time</th>";
				  echo "</tr>";
			 
			 	while ($rows3 = mysqli_fetch_array($result3,MYSQL_ASSOC))
				{
			     	echo "<tr>";
				    foreach ($rows3 as $data2)
				   {
				     echo "<td>". $data2 . "</td>";
				   }
				}
				}
				else
				{
					echo "<tr><td>No Withdrawal found!</td></tr>";
				}
				echo "</table></center>";
		 ?>
		</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
