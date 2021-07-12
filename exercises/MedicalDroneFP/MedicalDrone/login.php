<?php
    include "includes/config.php";
    //include 'includes/db.php';
    session_start();//on logout session_destroy();
    if(!empty($_POST["loginMail"])) { //true if form was submitted
        include 'includes/db.php';
        $query  = "SELECT * FROM `MD_UserID` WHERE Email= '" 
        . $_POST["loginMail"] 
        . "' and Password = '"
        . $_POST["loginPass"]
        ."'";
        // echo $query;//can't start echo if header comes after it
   
        $result = mysqli_query($connection , $query);
        //echo $query;
        $row = mysqli_fetch_array($result);
        
        if(is_array($row)) {
            $_SESSION["userId"] = $row['UserID'];
            $_SESSION["userType"] = $row['UserType'];
            $_SESSION["firstName"] = $row['FirstName'];
            $_SESSION["lastName"] = $row['LastName'];
            $_SESSION["email"] = $row['Email'];
            $_SESSION["phone"] = $row['Phone'];
            header('Location: ' . URL . 'index.php');
        } else {
            $message = "Invalid Username or Password!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> /
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="js/index.js"></script>
   
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> 
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> 

    <title>Login</title>
</head>
<body>
<div class="sidenav">
         <div class="login-main-text">
            <h2>Medical Drone<br> Welcome Back!</h2>
            <!-- <p></p> -->
         </div>
      </div>
      <div class="loginMain">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form action="#" method="post" id="loginForm">
                  <div class="form-group">
                     <label>Email</label>
                     <input type="email" class="form-control" id="loginMail" name="loginMail" placeholder="User Email" required>
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" id="loginPass" name="loginPass" placeholder="Password" pattern="^[#.0-9a-zA-Z\s,-]+$" required>
                  </div>
                  <button type="submit" class="btn btn-black">Login</button>
                 
                  <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div> 
               </form>
            </div>
         </div>

    <footer class="loginfooter">
    </footer>
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