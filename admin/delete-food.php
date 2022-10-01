<?php include('./partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Delete Food</h1>
        <?php
        if (isset($_GET['id']) and isset($_GET['image_name'])) {
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];
            // if image_name is not empty 
            if ($image_name != "") {
                 // image path 
                $path = '../images/food/' . $image_name;
                //remove image 
                if (unlink($path)) {
                    $_SESSION['delete-success'] = "<div class='success'>Delete Successfully</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                } else {
                    $_SESSION['delete-failed'] = "<div class='failure'>Delete Failed</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                }
            }

            $sql = "DELETE  FROM tbl_food WHERE id='$id'";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $_SESSION['delete-success'] = "<div class='success'>Delete Successfully</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['delete-failed'] = "<div class='failure'>Delete Failed</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-food.php');
        }
        ?>
    </div>
</div>
<!-- Main Content Section Ends -->


<?php include('./partials/footer.php'); ?>