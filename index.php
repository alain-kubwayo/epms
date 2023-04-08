<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./authStyles.css" />
    <title>EPMS Register</title>
</head>
<body>
    <div class="auth__container">
        <h1>EPMS: Register</h1>
        <form action="index.php" method="post">
            <input 
                type="text" 
                name="Username" 
                id="username" 
                placeholder="Username"
            />
            <input 
                type="email" 
                name="email" 
                id="email" 
                placeholder="Email"
            />
            <input 
                type="password" 
                name="password" 
                id="password"
                placeholder="Password"
            />
            <input 
                type="password" 
                name="password2" 
                id="password2"
                placeholder="Confirm password"
            />
            <button type="submit">Register</button>
            <div>
                <footer>Already a member? <a href="login.php">Login here</a></footer>
            </div>
        </form>
    </div>   
</body>
</html>
