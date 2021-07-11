<?php
	include "includes/config.php";
    include 'includes/db.php';
	session_start();//on logout session_destroy();

	if(!isset($_SESSION['userId'])) {
        header('Location: ' . URL . 'login.php');}

    $userID     = $_SESSION['userId'];
    //get data from querystring and escape variables for security
    $state      = $_GET['state'];
	$orderID    = $_GET['orderID'];

	/* delete query */
	if($state == "delete") {
		$query = "DELETE FROM `MD_Orders` WHERE OrderID='" . $orderID . "';";
	}
	else {	
		$from   	= mysqli_real_escape_string($connection, $_GET['from']);
		$to 	    = mysqli_real_escape_string($connection, $_GET['to']);
		$drone    	= mysqli_real_escape_string($connection, $_GET['chooseDrone']);
		$date		= mysqli_real_escape_string($connection, $_GET['date']);
		$item1    	= mysqli_real_escape_string($connection, $_GET['chooseItem1']);
		$units1   	= mysqli_real_escape_string($connection, $_GET['itemNumber1']);
		$item2   	= mysqli_real_escape_string($connection, $_GET['chooseItem2']);
		$units2    	= mysqli_real_escape_string($connection, $_GET['itemNumber2']);
		$item3    	= mysqli_real_escape_string($connection, $_GET['chooseItem3']);
		$units3    	= mysqli_real_escape_string($connection, $_GET['itemNumber3']);
		$note    	= mysqli_real_escape_string($connection, $_GET['notes']);

		//SET: insert/update data in DB
		if ($state == "insert") {
			$query = "INSERT INTO `MD_Orders`(
				`UserID` ,
				`From` ,
				`To` ,
				`DroneID` ,
				`Date` ,
				`ItemID1` ,
				`Quantity1` ,
				`ItemID2` ,
				`Quantity2` ,
				`ItemID3` ,
				`Quantity3` ,
				`Note`
				) VALUES ('$userID', '$from','$to','$drone', '$date','$item1','$units1','$item2','$units2','$item3','$units3','$note');";
			echo $query;
		}
		else {
			$query = "UPDATE `MD_Orders` SET 
			`From`='$from', 
			`To`='$to',
			`DroneID`='$drone',
			`Date`='$date',
			`ItemID1`='$item1',
			`Quantity1`='$units1',
			`ItemID2`='$item2',
			`Quantity2`='$units2',
			`ItemID3`='$item3',
			`Quantity3`='$units3',
			`Note`='$note' 
			WHERE OrderID='" . $_GET['orderID'] . "';";
			//echo $query;
		}
	}
	$result = mysqli_query($connection, $query);
	
    if(!$result) {
        die("DB query failed.");
    }
	else
		//header('Location: ' . URL . 'myOrders.php?orderID=' . $userID);
		header('Location: ' . URL . 'myOrders.php');
?>

<html>
	<!-- <head>
		<meta charset="utf-8">  
		<title>msg to user</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
		<!-- <link href="includes/style.css" rel="stylesheet"> -->
	<!-- </head>
	<body>
	    <div class="container">
			<h1>Save Product Details</h1>
			<h2>product was saved</h2>
			<a href="myOrders.php">click to see all products</a>
	    </div> -->
		<head></head>
		<body>
		<?php 
				//release returned data
                if(isset($result)){
				    mysqli_free_result($result);}
			?>
	</body>
</html>
<?php
//close DB connection
mysqli_close($connection);
?>
