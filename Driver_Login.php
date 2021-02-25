<html>
  <head>
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
  <div class="imgcontainer">
  </div>
  <span style="margin-left:19.3em;">
			<label><b><font size="5" color="black"></font></b></label>
			<span style="margin-left: 1.8em;">
			<input type="text" placeholder="Current Location" name="cl" >
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
		$did=$_POST["did"];
		$Password="'".$_POST["password"]."'";
		$DriverIDs = "SELECT * FROM drivers where 				DriverID=$did and trim($Password) LIKE 					trim(Password)" ;
		$IDs = $conn->query( $DriverIDs );
		$x=0;
		foreach($IDs as $ID)
		{
			$q1="update driver_status set Availability='Y' where DriverID=$did";
			$conn->query($q1);
		?>
		<h2>Login Successful</h2>
		<dl>
		<dt>Driver ID</dt><dd><?php
 		echo $ID["DriverID"]?></dd>
     		<dt>Email</dt><dd><?php echo $ID["Email"]?></dd>
     		<dt>Password</dt><dd><?php echo $ID["Password"]?>				</dd>
     		<dt>Registration No</dt><dd><?php echo 					$ID["VehicleID"]?></dd>
      	<dt>Vehicle Type</dt><dd><?php echo 						$ID["VehicleType"]?></dd>
		<dt>Distance Travelled</dt><dd><?php echo $ID["Distance"]?></dd>
    		</dl>
		<?php
		$x=$x+1;
		}
		if($x==0)
		{
			echo "<h2>Login Unsuccessful.<br><br>Incorrect Driver ID Or Password</h2>";
		}
}
catch ( PDOException $e ) {
  echo " Login Unsuccessful " . $e->getMessage();
}
?>
		<span style="margin-left: 27.3em;">
		<button type="submit"><a href="home.html" style="font-size: 19px;text-decoration:none;" ><font size="4">submit</font></button>
</body>
</html>