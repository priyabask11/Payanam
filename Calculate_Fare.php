<html>
  <head>
    <link rel="stylesheet" type="text/css" href="common.css" />
	<style>

input[type=email], input[type=password], input[type=text],input[type = number] 
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
		<form action="home.html" method="post">
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
		$cmail=$_POST["email"];
		$did=$_POST["did"];
		$source="'".$_POST["source"]."'";
		$dest="'".$_POST["dest"]."'";
		$vtype="'".$_POST["vtype"]."'";
		$h="select Distance from distances where trim(Source) LIKE trim($source) 
		AND Destination LIKE trim($dest)";
		$distances = $conn->query( $h);
		foreach($distances as $distance)
		{
			$dist=$distance["Distance"];
			$q="select RatePerKm from vehicle_types where Type LIKE trim($vtype)";
			$fares=$conn->query($q);
			foreach($fares as $fare)
			{
				$rate=$fare["RatePerKm"];
				$TotalFare=$rate*$dist;
				$getbalance="select Balance from customers where CustomerID=$cid";
				$b=$conn->query($getbalance);
				$amt=0;
				$bal=0;
				foreach($b as $balance)
				{
					$bal=$balance["Balance"];	
					if(($bal-$TotalFare)>=0)
					{
						$amt=0;
						$bal=$bal-$TotalFare;
					}
					else
					{
						$amt=$TotalFare-$bal;
						$bal=0;
					}
					$q1="update customers set Balance=$bal where CustomerID=$cid";
					$q2="update drivers set Distance=Distance+$dist where DriverID=$did";
					$q3="update driver_status set Availability='Y' where DriverID=$did";
					$q4="insert into ride_details(CustomerID,DriverID) values($cid,$did)";
					$q5="update driver_status set CurrentLocation = $dest where DriverID=$did";
					$conn->query($q1);	
					$conn->query($q2);
					$conn->query($q3);
					$conn->query($q4);		
					$conn->query($q5);
					?>
					<h2>Fare Details</h2> 
					<dl>
					<dt>Customer ID</dt><dd><?php echo $cid?></dd>
					<dt>Email ID Of The Customer</dt><dd><?php echo $cmail?></dd>
					<dt>Total Fare Rs.</dt><dd><?php echo $TotalFare?></dd>
					<dt>Amount To Be Paid</dt><dd><?php echo "Rs. ".$amt?></dd>
					<dt>Account Balance</dt><dd><?php echo "Rs. ".$bal?></dd>
					<span style="margin-left: 27.3em;">
						<button type="submit"><a href="" style="font-size: 19px;text-decoration:none;" ><font size="4">Pay & press</font></button> 
					</dl>
					<?php
				}
			}
		}
}
	catch ( PDOException $e ) {
  echo $e->getMessage();
}		
?>
</body>
</html>