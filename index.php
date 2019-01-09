<?php
session_start();
if(isset($_SESSION['user']))
{
	header("Location : ./dashboard/index.php");
}
include_once './db/server.php';

if(isset($_POST['login']))
{
    $emailPWrID = $_POST["emailPWrID"];
    $password = $_POST['password'];
    $password = md5($password); 

    $query = mysqli_query($link, "SELECT * FROM users WHERE userPWrID = '$emailPWrID' AND userPassword = '$password' OR userEmail = '$emailPWrID' AND userPassword = '$password'");
	if($query->num_rows != 0) {
        $_SESSION['user'] = true;
        header("Location : ./dashboard/index.php");
    } else {        
        $msg = 'Wrong credentials!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/style.css?version=51">
    <title>Dissertation Process</title>
</head>
<body>
    <div class="main">
        <h3 class="title">Dissertation Process</h3>
        <div class="form">
            <h2>Login Form</h2>
            <form method="POST">
                <span style="color:#2ecc71;"><?php echo @$msg;?></span>
                <table>
                    <tr>
                        <td><input type="text" name="emailPWrID" placeholder="Email or PWr ID" /></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="password" placeholder="Password" /></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="register.php" class="register">Register</a>
                            <input type="submit" name="login" value="Login" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>