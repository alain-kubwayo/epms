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
        <p style="text-align: center; margin: 10px auto; color: blue;">Poultry management system for small and medium-sized poultry farm businesses.</p>
        <div style="text-align: center;">
            <h2 style="color: #2c3e50; margin-bottom: 10px;">Use these credentials for now:</h2>
            <ul style="list-style-type: none; margin-left: 10px; margin-bottom: 10px;">
                <li><span style="font-weight: 900">Username: </span><span style="color: #192a56; font-weight: 700; font-size: 20px;">admin</span></li>
                <li><span style="font-weight: 900">Password: </span><span style="color: #192a56; font-weight: 700; font-size: 20px;">admin</span></li>
            </ul>
            <p style="color: #e67e22; font-weight: 600;">‼️ Full authentication is under construction...</p>
        </div>
        
        <form action="" method="post">
            <input type="text" name="Username" placeholder="Username">
            <input type="password" name="Password" placeholder="Password">
            <?php
            // display error message
            if(isset($message)){
                    echo '<label class="text-danger" style="margin-top: 20px;">' . $message . '</label>';
                }
            ?>
            <button type="submit" name="login">Login</button>
        </form>
    </div>   
</body>
</html>
