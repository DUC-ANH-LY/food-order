<?php include('partials/menu.php'); ?>
<!-- Menu Section Ends -->

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <!-- Add Category From Starts -->
        <?php
        if (isset($_SESSION['add-category'])) {
            echo $_SESSION['add-category'];
            unset($_SESSION['add-category']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Image Upload: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Feature: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Catogory" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else $featured = "No";
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else $active = "No";

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {

                    $ext = end(explode('.', $image_name));
                    $image_name = 'Food-Category_' . rand(000, 999) . '.' . $ext;
                    $source = $_FILES['image']['tmp_name'];
                    $des = '../images/category/' . $image_name;

                    $upload = move_uploaded_file($source, $des);
                    if (!$upload) {
                        $_SESSION['upload'] = "<div class='failure'>Failed to upload image.</div>";
                        header('location:' . SITEURL . '/admin/add-category.php');
                        die();
                    }
                }
            } else {
                $image = "";
            }





            // SQL query
            $sql = "INSERT INTO tbl_category  SET title='$title', image_name='$image_name',featured='$featured',active='$active'";

            $res = mysqli_query($conn, $sql);
            if ($res) {
                $_SESSION['add-category'] = "<div class='success'>Successfully Add Category</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add-category'] = "<div class='failure'>Failed to Add Category</div>";
                header("location:" . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
        <!-- Add Category From Starts -->

    </div>
</div>
<!-- Main Content Section Ends -->

<!-- Footer Section Starts -->
<?php include('partials/footer.php'); ?>