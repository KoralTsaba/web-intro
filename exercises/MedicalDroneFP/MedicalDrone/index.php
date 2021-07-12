<?php
    //include 'db.php';
    include "includes/config.php";
    session_start();//on logout session_destroy();
    
    if(!isset($_SESSION['userId'])) {
        header('Location: ' . URL . 'login.php');}
    else{
        //include 'includes/db.php';
        //$query = "SELECT * FROM `MD_UserID` WHERE UserID = '" . $_SESSION['userId'] . "'";
        //$result = mysqli_query($connection, $query);
        //$row = 
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="js/index.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@100&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ad8f5dd871.js" crossorigin="anonymous"></script>
    <script src="js/hamburger.js"></script>
    <title>Home Page</title>
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

    <div class="wrapper" id="wrapperHomePage">
        <main class="main" id="mainHomePage">
            <h1>WELCOME BACK<br> <b><?php echo $_SESSION['firstName']; ?> <?php echo $_SESSION['lastName']; ?> </b></h1>
            <section class="statistics">
                <section class="dataContainer">
                    <i class="fas fa-grin-hearts fa-3x"></i>
                    <p class="numbers">15,000</p>
                    <p class="description">Customers Recommend</p>
                </section>

                <section class="dataContainer">
                    <i class="fas fa-globe-americas fa-3x"></i>
                    <p class="numbers">27,350</p>
                    <p class="description">Online Drones</p>
                </section>

                <section class="dataContainer">
                    <i class="fas fa-medkit fa-3x"></i>
                    <p class="numbers">31,157</p>
                    <p class="description">Drugs shipped</p>
                </section>

                <section class="dataContainer">
                    <i class="fas fa-exclamation fa-3x"></i>
                    <p class="numbers">1,259</p>
                    <p class="description">Emergencies</p>
                </section>

            </section>
            <h1 id="homePageTitle">Select Your Drone</h1>

           
            <section class="droneChoose">
                <button id="buttonNavLeft" class="droneNavButton buttonLeft">
                    <img src="images/leftArrow.svg">
                </button>
                <div id="droneTypesContainer">
                    <section class="droneType" id="dron1">
                        <a href="newOrder.php?droneID=1" id="droneLink1">
                            <img src="images/camera-drone.svg">
                           <!-- <p>Standart</p>
                            <div>Up to 5kg</div> -->
                        </a>
                    </section>
                    <section class="droneType" id="dron2">
                        <a href="newOrder.php?droneID=2" id="droneLink2">
                            <img src="images/camera-drone.svg">
                           <!-- <p>Standart+</p>
                            <div>Up to 10kg</div> -->
                        </a>
                    </section>
                    <section class="droneType" id="dron3">
                        <a href="newOrder.php?droneID=3" id="droneLink3">
                            <img src="images/camera-drone.svg">
                           <!-- <p>Grand</p>
                            <div>Up to 15kg</div> -->
                        </a>
                    </section>
                    <section class="droneType" id="dron4">
                        <a href="newOrder.php?droneID=4" id="droneLink4">
                            <img src="images/camera-drone.svg">
                           <!-- <p>Grand+</p>
                            <div>Up to 20kg</div> -->
                        </a>
                    </section>
                    <section class="droneType" id="dron5">
                        <a href="newOrder.php?droneID=5" id="droneLink5">
                            <img src="images/camera-drone.svg">
                           <!-- <p>Special</p>
                            <div>Up to 30kg</div> -->
                        </a>
                    </section>
                </div>
                <button id="buttonNavRight" class="droneNavButton buttonRight">
                    <img src="images/rightArrow.svg">
                </button>
        </section>
        </main>
    </div>
    <footer class="placeholder-footer"></footer>
    <footer></footer>
    <script>
        (initialize());
        (hamburger());
    </script>
</body>

</html>