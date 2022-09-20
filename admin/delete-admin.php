<?php include('./partials/menu.php');    ?>

    <?php
    $id = $_GET['id'];

    $sql="DELETE FROM tbl_admin WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res) {
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['delete'] = "<div class='failure'>Failed To Deleted Admin</div>";
        header('location:'.SITEURL.'admin/delete-admin.php');
    }
    ?>

<?php include('./partials/footer.php');    ?>