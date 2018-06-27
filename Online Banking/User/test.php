<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Money Transaction</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <style>
	.error {color: #FF0000;}
  </style>
</head>

<body>
  <?php
   session_start();
   $servername="localhost";
   $username="root";
   $password="";
   $dbname="online_banking";
   $conn=mysqli_connect($servername,$username,$password,$dbname);
   $toAccErr="";
   $transaction="";
   $toAccount=$toName="";
    if(!$conn)
	{
	   die("Connection failed:".mysqli_connect_error());
	}
	 
    if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		
		 $fromAccount=$_POST["ufromacc"];
		 $toAccount=$_POST["utoacc"];
		 $transferAmt=$_POST["uamount"];
		 $toName=$_POST["utoname"];
		 
		 $sql1="SELECT * FROM account WHERE accountNum='$fromAccount'";
		 $result1=mysqli_query($conn,$sql1);
	     $row1=mysqli_fetch_array($result1);
		 $fromAmount=$row1['amount'];
		 
		 $sql2="SELECT * FROM account WHERE accountNum='$toAccount'";
		 $result2=mysqli_query($conn,$sql2);
		 $row2=mysqli_fetch_array($resul2);
		 $toAmount=$row2['amount'];
         $count = mysqli_num_rows($result2);
		 
		 if($count!=1)
		 {
			 $toAccErr="*To Account Not found";
			 $toAccount="";
			  $toName="";
		 }
		 else
		 {
			$toAccErr=$toAmount;
			/* if($fromAmount>$transferAmt)
			 {  
				$toAmount=$toAmount+200;
				$fromAmount=$fromAmount-$transferAmt;
				
                $sql3="UPDATE account SET amount='$fromAmount' WHERE accountNum='$fromAccount'";
				mysqli_query($conn,$sql3);
				$sql4="UPDATE account SET amount='$toAmount' WHERE accountNum='$toAccount'";
				mysqli_query($conn,$sql4);
				
				$transaction="Transaction successful";
				
				$sql5="INSERT INTO transaction_history(from_account,to_account,amount) VALUES ('".$fromAccount."', '".$toAccount."','".$transferAmt."')";
				mysqli_query($conn,$sql5);
			}
			 else
			 {
				$transaction=$_SESSION['Username1']." doesn't hava enough amount to transfer";
			 }*/
			 
		 }
	}
  ?>
  

		   <form method="POST">
				<span style="margin-left:12%">From Account </span><input type="text" name="ufromacc" value="<?php echo $_SESSION['AccountNo'];?>">
				<span style="margin-left:10%">To Account </span><input type="text" name="utoacc" value="<?php echo $toAccount;?>"> <span class="error"><?php echo $toAccErr?></span><br><br>
				<span style="margin-left:17%">Name </span><input type="text" name="ufromname" value="<?php echo $_SESSION['Username1']." ".$_SESSION['Username2'];?>">
				<span style="margin-left:14%">Name </span><input type="text" name="utoname" value="<?php echo $toName;?>"><br><br>
				<span style="margin-left:25%">Enter the amount you want to transfer </span><input type="text" name="uamount"><br><br>          				
				<center><input type="submit" value="Submit"></center>
				<br><br>
				<center><span class="error"><?php echo $transaction;?></span></center>
		   </form>
		</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
