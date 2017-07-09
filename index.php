<?php	
		 $Serial = shell_exec('wmic bios GET SerialNumber 2>&1');
		 $Serial = explode(" ",$Serial);
		 $Serial = trim($Serial[2]);
		 echo "Serial No = ".$Serial."<br>";
		 $UserName = shell_exec('whoami');
		 
		 $UserName1 = explode("\\",$UserName);
		 
		 $UserName1[1] = trim(preg_replace('/\s+/', ' ', $UserName1[1]));
		 
		 echo "Domain = ".$UserName1[0]."<br>";
		 echo "User = ".$UserName1[1]."<br>";
		 
		 $make = shell_exec('wmic csproduct get vendor, version');
		 $make = explode("\n",$make);
		 $make1 = explode(" ",$make[1]);
		 $brand = $make1[2];
		 
		 $model = $make1[3];
		 
		 echo "Brand = ".$brand."<br>";	
		echo "Model = ".$model."<br>";			 
		 
		 $username = "root";
		 $password = "";
		 $database = "serial_no";
		 $host = "localhost";
		 
		 $conn = mysqli_connect($host,$username,$password,$database);
		 
		 if($conn)
		 {
			 echo "Connected"."<br>";
			 $sql1 = "select * from serial_no where User = '$UserName1[1]'";
			 $query1 = mysqli_query($conn,$sql1);
			 if($query1)
			 {
				 $rows = mysqli_num_rows($query1);
				 if($rows>0)
				 echo "You Already Completed the Process";
				 else{
					 $sql2 = "insert into serial_no(Domain,User,Serial_No,Brand,Model) values('$UserName1[0]','$UserName1[1]','$Serial','$brand','$model')";
					 $query2 = mysqli_query($conn,$sql2);
					 if($query2)
					 {
						echo "You have Successfuly Completed the process";
					 }
					 else
						 echo "Tell IT Administrator about the issue";
					 
				 }
			 }
			 else
			 {
				 echo "Error Selecting rows";
			 }
		 }
		 else
			 echo "Connection Error ";
		 

?>
