<?php
    include "includes/config.php";
    //include 'includes/db.php';
    session_start();//on logout session_destroy();

    if(!isset($_SESSION['userId'])) {
        header('Location: ' . URL . 'login.php');}
    
    //$userID = $_SESSION['userId']; // maybe find another way with session, make sure its sent from other pages
    $state 	= "insert";
    //$orderID = $_GET["orderID"];
    
    if(!empty($_GET["orderID"])) {        //if empty the its insert otherwise its edit - possible id is not exist
        include 'includes/db.php';
        //include 'includes/config.php';
        $query = "SELECT * FROM `MD_Orders` where OrderID = '" . $_GET["orderID"] . "'";
        //echo $query;
        $result = mysqli_query($connection, $query);
        //$state = 'insert';
        if($result) {
            $row 	= mysqli_fetch_assoc($result);  //there is only 1 with id=X
            $state 	= "edit";
            //echo $state;
        }//what to do if id does not exist?? change state?!!!!!!!!!!!
    }

    

    $selected = ' selected="selected" ';
    
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="js/newOrder.js"></script>
    <script src="js/hamburger.js"></script>
    <title>Home Page</title>
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
            
            <section id="orderWrapper">
                <form id="deliveryForm" action="saveOrder.php" method="get">
                    <h1><?php echo (isset($row)) ? 'Edit order N' . $row["OrderID"] . ':' : 'New delivery:'?></h1>
                    <div class="mb-3">
                        <label for="from" class="form-label">From:</label>
                        <input type="text" class="form-control" id="from" name="from" placeholder="From which Hospital / Clinic.." pattern="^[#.0-9a-zA-Z\s,-]+$"  value="<?php echo (isset($row)) ? $row["From"] : ''?>" required >
                    </div>
                    <div class="mb-3">
                        <label for="to" class="form-label">To:</label>
                        <input type="text" class="form-control" id="to" name="to" placeholder="To which Hospital / Clinic.." pattern="^[#.0-9a-zA-Z\s,-]+$" value="<?php echo (isset($row)) ? $row["To"] : ''?>" required >
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Time to pickup:</label>
                        <input type="datetime-local" class="form-control" id="date" name="date" value="<?php echo (isset($row)) ? date('Y-m-d\TH:i:s', strtotime($row["Date"])) : ''?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="chooseDrone" class="form-label">Choose drone:</label>
                        <select class="form-select" id="chooseDrone" name="chooseDrone" data-selected= "<?php echo (isset($row)) ? $row["DroneID"] : $_GET["droneID"]?>" required>
                            <option value=""></option>
                            <option value="1" id="droneOp1" ></option>
                            <option value="2" id="droneOp2" ></option>
                            <option value="3" id="droneOp3" ></option>
                            <option value="4" id="droneOp4" ></option>
                            <option value="5" id="droneOp5" ></option>
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <label for="chooseItem1" class="form-label">Choose item one:</label>
                        <select class="form-select" id="chooseItem1" name="chooseItem1" data-selected= "<?php echo (isset($row)) ? $row["ItemID1"] : ''?>" required>
                            <option value=""></option>
                            <option value="1"></option>
                            <option value="2"></option>
                            <option value="3" ></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="itemNumber1" class="form-label">Units of item one:</label>
                        <input type="number" class="form-control" id="itemNumber1" name="itemNumber1" min="1" max="15" value="<?php echo (isset($row)) ? $row["Quantity1"] : ''?>" required>
                    </div>
             <div id="items2Container">    <div class="mb-3">
                        <label for="chooseItem2" class="form-label">Choose item two:</label>
                        <select class="form-select" id="chooseItem2" name="chooseItem2" data-selected="<?php echo (isset($row))&&$row["ItemID2"]>0 ? $row["ItemID2"] : ''?>">
                            <option value=""></option>
                            <option value="1"></option>
                            <option value="2"></option>
                            <option value="3"></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="itemNumber2" class="form-label">Units of item two:</label>
                        <input type="number" class="form-control" id="itemNumber2" name="itemNumber2" min="1" max="15" value="<?php echo (isset($row))&&$row["Quantity2"]>0 ? $row["Quantity2"] : ''?>">
                    </div>
             </div>   
             <div id="items3Container">          <div class="mb-3">
                        <label for="chooseItem3" class="form-label">Choose item three:</label>
                        <select class="form-select" id="chooseItem3" name="chooseItem3" data-selected="<?php echo (isset($row))&&$row["ItemID3"]>0 ? $row["ItemID3"] : ''?>">
                            <option value=""></option>
                            <option value="1"></option>
                            <option value="2"></option>
                            <option value="3"></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="itemNumber3" class="form-label">Units of item three:</label>
                        <input type="number" class="form-control" id="itemNumber3" name="itemNumber3" min="1" max="15" value="<?php echo (isset($row))&&$row["Quantity3"]>0 ? $row["Quantity3"] : ''?>" >
                    </div>
             </div>      
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"> <?php echo (isset($row)) ? $row["Note"] : ''?> </textarea>
                    </div>
                    <input type="hidden" name="state" value="<?php echo $state;?>"> <!--new-->
				    <input type="hidden" name="orderID" value="<?php echo $_GET["orderID"];?>"> <!--new-->
                    <input type="hidden" name="userID" value="<?php echo $userID;?>"> <!--new-->
                    <button type="button" class="btn btn-primary" id="submitBtn">Submit</button> <!--type submit make it rapid-->
                </form>

                </section>    
    
    <footer>

    </footer>
    <script>
        (initialize());
        (hamburger());
    </script> 
    <?php 
				//release returned data
                if(isset($result)){
				    mysqli_free_result($result);}
			?>
</body>
</html>
<?php
//close DB connection
if(isset($connection)){
mysqli_close($connection);}
?>