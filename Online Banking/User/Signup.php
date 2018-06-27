<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
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
	$existsErr="";
   
    if(isset($_SESSION["AccountNo"]))
    {
	   unset($_SESSION["AccountNo"]);
    }
	
     $fNErr = $lNErr = $genderErr= $ageErr = $addressErr = $districtErr = $stateErr = $emailErr = $mobNoErr = $accNoErr = $passErr = $repassErr = "";
	 $fName = $lName = $gender = $age = $address = $district = $state = $email = $mobNo = $accNo = $pass = $repass ="";
	 $count=0;
	 if ($_SERVER["REQUEST_METHOD"] == "POST") 
	 {
	   if (empty($_POST["ufname"])) 
	   {
			$fNErr = "First name is required";
			$count+=1;
       }
	   else 
	   {
			$fName = test_input($_POST["ufname"]);
			if (!preg_match("/^[A-Z][a-z]+$/",$fName)) 
			{
			$fNErr = "Enter the correct first name. Ex:Jeba"; 
			$count+=1;
			$fName="";
			}
	   }
	   
	   if (empty($_POST["ulname"])) 
	   {
			$lNErr = "Last name is required";
			$count+=1;
       }
	   else 
	   {
			$lName = test_input($_POST["ulname"]);
			if (!preg_match("/^[A-Z][a-z]+$/",$lName)) 
			{
			$lNErr = "Enter the correct last name. Ex:Banu"; 
			$count+=1;
			$lName="";
			}
	   }
	   
	   if (empty($_POST["ugender"])) 
	   {
			$genderErr = "Choose your gender";
			$count+=1;
       }
	   else
	   {
		   $gender=test_input($_POST["ugender"]);
	   }
	   
	   if (empty($_POST["uage"])) 
	   {
			$ageErr = "Enter your age";
			$count+=1;
       }
	   else 
	   {
			$age = test_input($_POST["uage"]);
			if (!preg_match("/^[0-9]{1,2}$/",$age)) 
			{
			$ageErr = "Age should between 1 to 99"; 
			$count+=1;
			$age="";
			}
	   }
	   
	   if (empty($_POST["uaddress"])) 
	   {
			$addressErr = "Address is required";
			$count+=1;
       }
	   else 
	   {
			$address = test_input($_POST["uaddress"]);
	   }
	   
	   if (empty($_POST["udistrict"])) 
	   {
			$districtErr = "Choose your district";
			$count+=1;
       }
	   else 
	   {
			$district = test_input($_POST["udistrict"]);
	   }
	   
	   if (empty($_POST["ustate"])) 
	   {
			$stateErr = "Choose your state";
			$count+=1;
       }
	   else 
	   {
			$state = test_input($_POST["ustate"]);
	   }
	   
	   if (empty($_POST["umail"])) 
	   {
			$emailErr = "Email id is required";
			$count+=1;
       }
	   else 
	   {
			$email = test_input($_POST["umail"]);
			if (!preg_match("/^[a-zA-Z0-9_]+@[a-z]+\.+[a-z]{2,5}$/",$email)) 
			{
			$emailErr = "Your mail id is wrong. Ex:jeba1140@gmail.com"; 
			$count+=1;
			$email="";
			}
	   }
	   
	   if (empty($_POST["umobile"])) 
	   {
			$mobNoErr = "Enter your mobile number";
			$count+=1;
       }
	   else 
	   {
			$mobNo = test_input($_POST["umobile"]);
			if (!preg_match("/^[0-9]{10}+$/",$mobNo)) 
			{
			$mobNoErr = "Mobile number should have 10 digits"; 
			$count+=1;
			$mobNo="";
			}
	   }
	   
	   if (empty($_POST["uaccountno"])) 
	   {
			$accNoErr = "Account number is required";
			$count+=1;
       }
	    else 
	   {
			$accNo = test_input($_POST["uaccountno"]);
			if (!preg_match("/^[0-9]{6}+$/",$accNo)) 
			{
			$accNoErr = "Account number should have 6 digits"; 
			$count+=1;
			$accNo="";
			}
	   }
	   
	   if (empty($_POST["upassword"])) 
	   {
			$passErr = "Password is required";
			$count+=1;
       }
	   else 
	   {
			$pass= test_input($_POST["upassword"]);
			if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/",$pass)) 
			{
			$passErr = "Min length 8: Ex.Jb4841140"; 
			$count+=1;
			$pass="";
			}
	   }
	   
	   if (empty($_POST["upassword2"])) 
	   {
			$repassErr = "Enter repassword";
			$count+=1;
       }
	   else 
	   {
			$repass = test_input($_POST["upassword2"]);
			if($pass!=$repass)
			{
				$repassErr="Password does not match";
				$count+=1;
				$repass="";
			}
	   }
     }
	 $amount=1000;
	 if (isset($_POST['submit1']))
	 {
		  if($count==0)
		  {
			$conn=mysqli_connect($servername,$username,$password,$dbname);
			if(!$conn)
			{
				die("Connection failed:".mysqli_connect_error());
			}
			$sql="INSERT INTO User_Details(firstName, lastName, gender, age, address, district, state, email, mobileNo, accountNo, Password) VALUES ('".$fName."', '".$lName."', '".$gender."', '".$age."', '".$address."', '".$district."', '".$state."', '".$email."', '".$mobNo."', '".$accNo."', '".$pass."')";			
			$sql2="INSERT INTO account(accountNum, amount) VALUES ('".$accNo."', '".$amount."')";			
            
			if(mysqli_query($conn,$sql))
			{
				//$_SESSION["AccountNo"]=$_POST["uaccountno"];
				mysqli_query($conn,$sql2);
				header("Location:Login.php");
			}
			else
			{
				$existsErr="Account already exists";
				echo "Error:".$sql."<br>".mysqli_error();
			}
			mysqli_close($conn);
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
		
		<div class="header2">
			<div>Online<span> Banking</span> System</div>
		</div>
		<div class="signup"><br>
		        <span id="span1"><u>Create an account</u></span><br><br>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
			
				<span style="margin-left:35%">First Name </span><input type="text" name="ufname" id="ufname" value="<?php echo $fName;?>">
					<span class="error">* <?php echo $fNErr;?></span><br><br>
					
				<span style="margin-left:35%">Last Name </span><input type="text" name="ulname" id="ulname" value="<?php echo $lName;?>">
					<span class="error">* <?php echo $lNErr;?></span><br><br>
					
				<span style="margin-left:37%">Gender </span>
					<input type="radio" name="ugender" value="male" checked> Male
					<input type="radio" name="ugender" value="female"> Female
					<input type="radio" name="ugender" value="other"> Other  
					<span class="error">* <?php echo $genderErr;?></span><br><br>
					
				<span style="margin-left:39%">Age </span><input type="number" name="uage" id="uage" value="<?php echo $age;?>">
					<span class="error">* <?php echo $ageErr;?></span><br><br>
					
				<span style="margin-left:36%">Address </span><input type="text" name="uaddress" value="<?php echo $address;?>">
					<span class="error">* <?php echo $addressErr;?></span><br><br>
					
				<span style="margin-left:36%">District </span>
				<select name="udistrict">
				       <option value="Tirunelveli">Tirunelveli</option>
					   <option value="Tiruppur">Tiruppur</option>
					   <option value="Kanyakumari">Kanyakumari</option>
					   <option value="Madurai">Madurai</option>
					   <option value="Vellore">Vellore</option>
					   <option value="Coimbatore">Coimbatore</option>
					   <option value="Chennai<">Chennai</option>
					   <option value="Others">Others</option>
				 </select>
					<span class="error">* <?php echo $districtErr;?></span><br><br>  
					
				<span style="margin-left:38%">State</span> <select name="ustate" value="<?php echo $state;?>">
					   <option value="Tamilnadu">Tamilnadu</option>
				      </select>
					<span class="error">* <?php echo $stateErr;?></span><br><br>
					
				<span style="margin-left:37%">Email </span><input type="text" name="umail" value="<?php echo $email;?>">
					<span class="error">* <?php echo $emailErr;?></span><br><br>
					
				<span style="margin-left:34%">Mobile no </span><input type="number" name="umobile" value="<?php echo $mobNo;?>"> 
					<span class="error">* <?php echo $mobNoErr;?></span><br><br>
				
                <span style="margin-left:33%">Account no </span><input type="number" name="uaccountno" value="<?php echo $accNo;?>"> 
					<span class="error">* <?php echo $accNoErr;?>
					<?php echo $existsErr;?></span><br><br>
					
                <span style="margin-left:35%">Password </span><input type="password" name="upassword" value="<?php echo $pass;?>"> 
					<span class="error">* <?php echo $passErr;?></span><br><br>
					
                <span style="margin-left:30%">Reenter Password </span><input type="password" name="upassword2" value="<?php echo $repass;?>"> 
					<span class="error">* <?php echo $repassErr;?></span><br><br>
					
                <span style="margin-left:32%;color:blue"><a href="Login.php"><u>Already a User</u></a></span>				
				<input type="submit" value="Submit" name="submit1">
			</form>
		</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
