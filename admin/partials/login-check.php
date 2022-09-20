<?php
    if(!isset($_SESSION['user'])){
        $_SESSION['no-login-message'] = '<div class="failure">Please login to access</div>';
        header('location:'.SITEURL.'admin/login.php');
    }
?>