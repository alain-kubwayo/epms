<?php
    include 'includes/database.php';
    include 'includes/loginServer.php';
    session_start();
    // instantiating LoginServer class to access its functions/methods
    $data = new LoginServer();
    // variable to store message
    $message = "";
    // check if login was clicked
    if(isset($_POST["login"])){
        $field = array(
            "Username" => $_POST["Username"],
            "Password" => $_POST["Password"]
        );
        if($data->loginValidation($field)){
            if($data->canLogin("User", $field)){
                $_SESSION["Username"] = $_POST["Username"];
                header("location: dashboard.php");
            }else{
                $message = $data->error;
            }
        }else{
            // if input fields are blank, execute else statement: if both input fields are blank
            $message = $data->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./authStyles.css" />
    <title>EPMS Login</title>
</head>
<body>
    <div class="auth__container">
        <h1>EPMS: Admin Login</h1>
        <?php
            // display error message
            if(isset($message)){
                echo '<label class="text-danger">' . $message . '</label>';
            }
        ?>
        <form action="" method="post">
            <input type="text" name="Username" placeholder="Username">
            <input type="password" name="Password" placeholder="Password">
            <button type="submit" name="login">Login</button>
        </form>
    </div>   
</body>
</html>