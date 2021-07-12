<?php

    include "includes/config.php"; 
    include 'includes/db.php';
    
    session_start();

	if(!isset($_SESSION['userId'])) {
        header('Location: ' . URL . 'login.php');}

    if(isset($_POST["firstName"])) {
        $query = 'update MD_UserID set FirstName="'.$_POST["firstName"].'", LastName="'.$_POST["lastName"].'", Email="'.$_POST["eMail"].'", Phone="'.$_POST["phone"].'" where UserID='.$_SESSION["userId"];
        if(mysqli_query($connection, $query)) {
            $_SESSION["firstName"] = $_POST['firstName'];
            $_SESSION["lastName"] = $_POST['lastName'];
            $_SESSION["email"] = $_POST['eMail'];
            $_SESSION["phone"] = $_POST['phone'];
        }
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

    <title>Profile Page</title>
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
<div class="container" style="margin-top:25px;">
<div class="row gutters">
<div class="col-12">
<div class="card h-100">
	<div class="card-body">
        <form action="profile.php" method="POST" class="col-12">
		<div class="row gutters g-3">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-primary">Personal Details</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="fullName">Fisrt Name</label>
					<input type="text" class="form-control" name="firstName" value="<?php echo $_SESSION["firstName"]; ?>" <?php echo isset($_GET["editMode"]) ? "" : "disabled"; ?> >
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="eMail">Email</label>
					<input type="email" class="form-control" name="eMail" value="<?php echo $_SESSION["email"]; ?>" <?php echo isset($_GET["editMode"]) ? "" : "disabled"; ?>>
				</div>
			</div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="website">Last Name</label>
                    <input type="text" class="form-control" name="lastName" value="<?php echo $_SESSION["lastName"]; ?>" <?php echo isset($_GET["editMode"]) ? "" : "disabled"; ?>>
                </div>
            </div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="text" class="form-control" name="phone" value="<?php echo $_SESSION["phone"]; ?>" <?php echo isset($_GET["editMode"]) ? "" : "disabled"; ?>>
				</div>
			</div>
		</div>
		
		<div class="row gutters" style="margin-top:20px;">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="text-right">
					<?php echo isset($_GET["editMode"]) ? '<a type="button" href="profile.php" class="btn btn-secondary">Cancel</a>':""; ?>
					<?php echo isset($_GET["editMode"]) ? '<input type="submit" value="Save" class="btn btn-primary">' : '<a type="button" href="profile.php?editMode" class="btn btn-primary">Edit</a>'; ?>
				</div>
			</div>
		</div>
        </form>
	</div>
</div>
</div>
</div>
</div>
<footer></footer>
    <script>
        (hamburger());
    </script>
</body>
</html>