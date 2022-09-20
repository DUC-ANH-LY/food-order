<?php include('../config/constants.php');

?>
<html>

<head>
    <title>Login Food Order</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body style="width:50%; margin:100px auto; border:1px solid black;  position:sticky;">
    <form action="" method="POST">
        <div class="imgcontainer">
            <img src="https://cdn5.vectorstock.com/i/1000x1000/77/59/user-login-or-authenticate-icon-personal-vector-29007759.jpg" alt="Avatar" class="avatar">
        </div>
        <?php


        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>

        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit" name="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</body>

</html>

<br><br><b><br>
    <?php
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";

        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $_SESSION['login'] = "<div class='success'> Login successfully </div>";
            $_SESSION['user']=$username;
            header('location: ' . SITEURL . 'admin/');
            
        } else {
            $_SESSION['login'] = '<div class="failure">Login Fail</div>';
            header('location: ' . SITEURL . 'admin/login.php');
        }
    }
    ?>
