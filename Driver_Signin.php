<html>
	<head>
		<title>Thank You</title>
		<link rel="stylesheet" type="text/css" href="common.css" />
		<style>

input[type=email], input[type=password], input[type=text] 
{
    width: 30%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color:#1B2631;
    color: white;
    padding: 7px 10px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 30%;
}

button:hover {
    opacity: 0.5;
}

/*.cancelbtn {
    width: auto;
    padding: 5px 9px;
    background-color: white;
}*/

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
a{
	color:white;
}
</style>

	</head>
 
  <body>
  	
<img src='image/1.jpg' style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;-webkit-filter: blur(3px);filter: blur(3px);'>
	<form action="home.html" method="post">
    <p>Thank you for registering.</p>    
	<?php
		$database="mysql:dbname=cabs";
		$username="root";
		$password="";
		$conn=new PDO($database,$username,$password);
		try {
  			$conn = new PDO( $database, $username,$password );
 		     $conn->setAttribute( PDO::ATTR_ERRMODE, 			PDO::ERRMODE_EXCEPTION );
			
			} catch ( PDOException $e ) {
 		 echo "Connection failed: " . $e->getMessage();
			}
	try {
		$driverID = "SELECT max(DriverID) as ID FROM drivers";
		$IDs = $conn->query( $driverID );
		$newID=0;
		foreach($IDs as $ID)
		{
			$newID=$ID["ID"]+1;
		}
	$driverEmail="'".$_POST["mail"]."'";
	$driverPassword="'".$_POST["pwd"]."'";
	$driverRegNo="'".$_POST["numb"]."'";
	$driverVtype="'".$_POST["vtype"]."'";
	$cl = "psg";
	$newDriver="insert into drivers "."(DriverID,Email,Password,VehicleID,VehicleType,Distance) "."values ($newID,$driverEmail,$driverPassword,$driverRegNo,$driverVtype,0.0)";
	$x=$conn->prepare($newDriver);
	$x->execute();
	$newDriverStatus="insert into driver_status(DriverID,CurrentLocation,Availability) values ('$newID','$cl','Y')";
	$y=$conn->prepare($newDriverStatus);
	$y->execute();
}
catch ( PDOException $e ) {
  echo "Registration Unsuccessfull " . $e->getMessage();
}
	?>
	<dl>
	<dt>Driver ID</dt><dd><?php echo $newID?></dd>
      <dt>Email</dt><dd><?php echo $driverEmail?></dd>
      <dt>Password</dt><dd><?php echo $driverPassword?></dd>
      <dt>Vehicle Registration No</dt><dd><?php echo $driverRegNo?></dd>.
      <dt>Vehicle Type</dt><dd><?php echo $_POST["vtype"]?></dd>
    </dl>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<span style="margin-left: 27.3em;">
	<button type="Complete"><a href="home.html" style="font-size: 19px;text-decoration:none;" ><font size="4">Complete</font></button>
    <br>
    </div>
	</form>
	<span style="margin-left:27.3em;">
    <br>
</body>
</html>