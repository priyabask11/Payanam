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
  <img src='image/1.jpg' style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;-webkit-filter: blur(0px);filter: blur(0px);'>
	<form action="Ride_Booking.php" method="post">
	<div class="imgcontainer">
 
	</div>
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
		$cid=$_POST["cid"];
		$Password="'".$_POST["password"]."'";
		$customerIDs = "SELECT * FROM customers where 				CustomerID=$cid and trim($Password) LIKE 					trim(Password)" ;
		$IDs = $conn->query( $customerIDs );
		$x=0;
		foreach($IDs as $ID)
		{
		?>
		<h2>Login Successful</h2>
		<dl>
			<dt>Customer ID</dt><dd><?php
 			echo $ID["CustomerID"]?></dd>
      		<dt>Name</dt><dd><?php echo $ID["Email"]?></dd>
      		<dt>Password</dt><dd><?php echo $ID["Password"]?>				</dd>
      		<dt>Phone No</dt><dd><?php echo $ID["Phone"]?>				</dd>
      		<dt>Balance</dt><dd><?php echo $ID["Balance"]?>				</dd>
    		</dl>
		<h2>Book A Ride</h2>
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
		<div style="width: 30em;">
		<form action="Ride_Booking.php" method="post">
		<span style="margin-left:19.3em;">
		<label><b><font size="5" color="black">Source</font></b></label>
		<span style="margin-left: 1.8em;">
		<input type="text" placeholder="Source" name="src" >
		<br>
		<span style="margin-left:19.3em;">
		<label><b><font size="5" color="black">Destination</font></b></label>
		<span style="margin-left: 1.3em;">
		<input type="text" placeholder="Destination" name="dest" required>
		<input type="hidden" name="cid" value=<?php echo $cid?>>
		<input type="hidden" name="cmail" value=<?php echo $ID["Email"]?>>
		<br>
		<span style="margin-left: 27.3em;">
		<button type="submit"><a href="Ride_Booking.php" style="font-size: 19px;text-decoration:none;" ><font size="4">Press To Ride</font></button>
        </div>
		</form>
		<?php
		$x=$x+1;
		}
		if($x==0)
		{
			echo "<h2>Login Unsuccessful.<br><br>Incorrect Customer ID Or Password</h2>";
		}
}
catch ( PDOException $e ) {
  echo " Login Unsuccessful " . $e->getMessage();
}
?>
</body>
</html>