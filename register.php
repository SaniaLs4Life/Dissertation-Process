<?php
session_start();
if(isset($_SESSION['user']))
{
	header("Location : ./dashboard/index.php");
}
include_once './db/server.php';

if(isset($_POST['register']))
{
	$userPWrID = $_POST["userPWrID"];
    $userFullName = $_POST["userFullName"];
    $userEmail = $_POST["userEmail"];
    $userDepartment = $_POST["userDepartment"];
    $password = $_POST['password'];
    $password = md5($password); 
    $userType = "0";

    $query = mysqli_query($link, "SELECT * FROM users WHERE userPWrID = '$userPWrID' OR userEmail = '$userEmail'");
	if($query->num_rows != 0) {
        $msg = 'PWr ID or User Email already exists!';
    } else {
        $query = mysqli_query($link, "INSERT INTO users (userPWrID, userFullName, userEmail, userDepartment, userPassword, userType) VALUES ('$userPWrID', '$userFullName', '$userEmail', '$userDepartment', '$password', '$userType')");
        if($query == true) {
            $msg = 'You have successfully registered.';
        } else {
            $msg = 'An error has occured!';
        }
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
    <link rel="stylesheet" type="text/css" href="css/style.css?version=51">
    <title>Dissertation Process</title>
</head>
<body>
    <div class="main">
        <h3 class="title">Dissertation Process</h3>
        <div class="form">
            <h2>Registration Form</h2>
            <form method="POST">
                <span style="color:#2ecc71;"><?php echo @$msg;?></span>
                <table>
                    <tr>
                        <td><input type="text" name="userPWrID" placeholder="PWr ID" /></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="userFullName" placeholder="FullName" /></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="userEmail" placeholder="Email" /></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="userDepartment" placeholder="Department" /></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="password" placeholder="Password" /></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="index.php" class="register">Login</a>
                            <input type="submit" name="register" value="Register" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>