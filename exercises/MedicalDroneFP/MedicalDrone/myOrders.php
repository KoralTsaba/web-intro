<?php 
    include "includes/config.php";
    include 'includes/db.php';
    session_start();//on logout session_destroy();

	if(!isset($_SESSION['userId'])) {
        header('Location: ' . URL . 'login.php');}

    $userID     = $_SESSION['userId'];
    $query = "SELECT * FROM `MD_Orders` WHERE UserID = '" . $userID . "' order by date DESC;";
        //echo $query;
	$result = mysqli_query($connection, $query);
    if(!$result) {
        die("DB query failed.");
    }
    //$row 	= mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/myOrders.js"></script>
    <script src="js/hamburger.js"></script>
    <title>My Orders</title>
</head>
<body>
    <header>
    <section class="sideNave">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" id="closebtn" >&times;</a>
                <a class="selectedN" href="index.php">Home</a>
                <a href="newOrder.php">Delivery</a>
                <a href="myOrders.php">My Orders</a>
                <a href="#">Reports</a>
                <a href="#">Settings</a>
            </div>
            <span class="humburger" id="humburger" style="font-size:30px;cursor:pointer" >&#9776;</span>
        </section>
        <a href="index.php" id="logo"></a>
        <div class="line-nav">
            <nav class="nav" >
                <ul>
                    <li><a href="index.php"> Home</a></li>
                    <li><a href="newOrder.php"> Delivery</a></li>
                    <li><a href="myOrders.php">My orders</a></li>
                    <li><a href="#">Reports</a></li>
                    <li><a href="#">Settings</a></li>
                </ul>
            </nav>
         </div>
   
    </header>
    <div class="wrapper">
        <main class="main">
            <div class="ordersListContainer">
                <h1>Active orders</h1>
                <ul class="ordersList">

                 
                <?php // active order
                    while(($row = mysqli_fetch_assoc($result)) && (strtotime($row["Date"]) > strtotime('now'))) {//results are in associative array. keys are cols names
                        //if(strtotime($row["date"]) > strtotime('now')) { // compare time
                            //echo '<li><a href="order.html?orderId=' . $row["OrderID"] . '">';
                            echo '<li><a href="order.php?orderId=' . $row["OrderID"] . '&from=' . $row["From"] . '&to=' . $row["To"] . '&drone=' . $row["DroneID"] . '&item1=' 
                                                                    . $row["ItemID1"] . '&units1=' . $row["Quantity1"] . '&item2=' . $row["ItemID2"] . '&units2=' . $row["Quantity2"] . '&item3=' . $row["ItemID3"] . '&units3=' . $row["Quantity3"] . '&date=' . $row["Date"] . '">';
                            echo '<span class="orderAddress">Order N' . $row["OrderID"] . ' | From: ' . $row["From"] . '  To: ' . $row["To"] .  '</span>';
                            echo ' <span class="orderDate">' . date_format((new DateTime($row["Date"])),"H:i") . '</span>';
                            echo '<img src="images/rightArrow.svg"></img>';
                            echo '</a></li>';
                    }        
                ?> 
                </ul>
            </div>
            <div class="ordersListContainer">
                <h1>Past orders</h1>
                <ul class="ordersList">

                <?php //past order
                    while($row = mysqli_fetch_assoc($result)) {//results are in associative array. keys are cols names
                        //if(strtotime($row["date"]) > strtotime('now')) { // compare time
                            echo '<li><a href="order.php?orderId=' . $row["OrderID"] . '&from=' . $row["From"] . '&to=' . $row["To"] . '&drone=' . $row["DroneID"] . '&item1=' 
                                                                    . $row["ItemID1"] . '&units1=' . $row["Quantity1"] . '&item2=' . $row["ItemID2"] . '&units2=' . $row["Quantity2"] . '&item3=' . $row["ItemID3"] . '&units3=' . $row["Quantity3"] . '&date=' . $row["Date"] . '">';
                            echo '<span class="orderAddress">Order N' . $row["OrderID"] . ' | From: ' . $row["From"] . '  To: ' . $row["To"] .  '</span>';
                            echo ' <span class="orderDate">' . date_format((new DateTime($row["Date"])),"d/m/Y") . '</span>';
                            echo '<img src="images/rightArrow.svg"></img>';
                            echo '</a></li>';
                    }        
                ?> 
                </ul>
            </div>   
        </main>
        <footer></footer>
    </div>
    <script>
        (hamburger());
    </script>
    <?php 
			//release returned data
			mysqli_free_result($result);
	?>
</body>
</html>
<?php
//close DB connection
mysqli_close($connection);
?>