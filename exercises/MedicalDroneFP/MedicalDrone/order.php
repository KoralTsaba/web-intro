
<?php
    include "includes/config.php"; 
    include 'includes/db.php';
    session_start();//on logout session_destroy();

	if(!isset($_SESSION['userId'])) {
        header('Location: ' . URL . 'login.php');}

    //$userID     = $_SESSION['userId'];
    //$to     = $_GET["to"];   
?>
<!-- compare php variable to javascript variable-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/order.js"></script>
    <script src="js/hamburger.js"></script>
    <title>Order</title>
</head>
<body>
    <header>
    <section class="sideNave">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" id="closebtn" >&times;</a>
                <a class="selectedN" href="index.php">Home</a>
                <a href="profile.php">Profile</a>
                <a href="newOrder.php">Delivery</a>
                <a href="myOrders.php">My Orders</a>
                <a href="#">Reports</a>
                <a href="#">Settings</a>
            </div>
            <span class="humburger" id="humburger" style="font-size:30px;cursor:pointer" >&#9776;</span>
        </section>

        <a href="index.php" id="logo"></a>
        <div class="line-nav">
            
            <nav class="nav">
                <ul>
                    <li><a href="index.php"> Home</a></li>
                    <li><a href="newOrder.php"> Delivery</a></li>
                    <li><a href="myOrders.php">My orders</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="#">Reports</a></li>
                    <li><a href="#">Settings</a></li>
                </ul>
            </nav>
        </div>
      
    </header>
        <div class="wrapper">
            <main class="orderMain">
                <a href="myOrders.php?userID='<?php echo $_SESSION['userId']; ?>'" class="backButton"> <!-- to check what need to be return UserID?-->
                    <img src="images/arrowLeft.svg"></img> 
                    Back to order history
                </a>
                <h1>Delivery Report for : Order number  <?php echo $_GET["orderId"]; ?></h1>
                <p><?php echo date_format((new DateTime($_GET["date"])),"d/m/Y"); ?></p>

                <div class="receiptItemContainer">
                    <div class="itemContainer">
                        <h1>Items</h1>
                        <hr>
                        <ul>
                            <li id='item1' data-type='<?php echo $_GET["item1"]; ?>' data-units='<?php echo $_GET["units1"]; ?>'></li>
                            <li id='item2' data-type='<?php echo $_GET["item2"]; ?>' data-units='<?php echo $_GET["units2"]; ?>'></li>
                            <li id='item3' data-type='<?php echo $_GET["item3"]; ?>' data-units='<?php echo $_GET["units3"]; ?>'></li> 
                        </ul>
                    </div>
                    <div class="itemContainer">
                        <h1 data-drone>Drone</h1>
                        <hr>
                        <ul>
                            <li id='droneType' data-drone='<?php echo $_GET["drone"]; ?>'></li>
                            <li><b>Pickup time: </b> <?php echo date('d/m/Y H:i:s', strtotime($_GET["date"]))?> </li>
                        </ul>
                    </div>
                    <div class="itemContainer">
                        <h1>Delivery Address</h1>
                        <hr>
                        <ul>
                            <li><b>From:</b> <?php echo $_GET["from"]; ?></li>
                            <li><b>Destination:</b> <?php echo $_GET["to"]; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="buttons">
                    <button onclick="location.href='newOrder.php?orderID=<?php echo $_GET['orderId'] ?>'">Edit order</button>
                     <?php 
                        if($_SESSION["userType"] == 0)
                            echo "<button onclick=" . '"location.href=' . "'saveOrder.php?orderID=" . $_GET["orderId"] . '&state=delete' . "'" . '">Delete order</button>';
                            //not last // echo "<a href='newOrder.php?orderID=" . $_GET["orderId"] . "><button>Edit order</button></a>";
                     ?>

                </div>

            </main>
        </div>

    <footer></footer>
    <script>
        (initialize());
        (hamburger());
    </script>
    
</body>
</html>