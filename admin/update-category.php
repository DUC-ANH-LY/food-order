<?php include('./partials/menu.php'); ?>
<?php
$id = $_GET['id'];
if (isset($id)) {
    $sql = "SELECT * FROM tbl_category WHERE id= '$id'";
    $res = mysqli_query($conn, $sql);
    $count  = mysqli_num_rows($res);
    if ($count == 1) {
        $rows = mysqli_fetch_assoc($res);
        $title = $rows['title'];
        $current_image = $rows['image_name'];
        $featured = $rows['featured'];
        $active = $rows['active'];
    } else {
        $_SESSION['no-catergory-found'] = "<div class='failure'>Category not found</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else header('location:' . SITEURL . 'admin/manage-category.php');

// if (isset($_SESSION['update-category'])) {
//     echo $_SESSION['update-category'];
//     unset($_SESSION['update-category']);
// }
if (isset($_SESSION['upload'])) {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <!-- Update Category From Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title" value="<?php echo $title ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>

                            <img src="../images/category/<?php echo $current_image; ?>" width="100px">

                        <?php
                        } else {
                            echo "<div class='failure'>Image not Added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") echo "checked"; ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") echo "checked"; ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") echo "checked"; ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") echo "checked"; ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Catogory" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php


        if (isset($_POST['submit'])) {
            // get all data from form 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];



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
                        header('location:' . SITEURL . '/admin/manage-category.php');
                        die();
                    }

                    // remove curernt image
                    if ($current_image != "") {

                        $des = '../images/category/' . $current_image;

                        $remove = unlink($des);
                        // check whether image is removed or not
                        //if failed to remove then display the message and stop the process
                        if (!$remove) {
                            //failed to remove image
                            $_SESSION['failed-remove'] = "<div class='failure'>Failed to remove current image.</div>";
                            header('location:' . SITEURL . '/admin/manage-category.php');
                            die(); //stop process
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }





            // SQL query and update to database
            $sql2 = "UPDATE tbl_category SET 
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                WHERE id='$id'
            ";
            // excute the query
            $res = mysqli_query($conn, $sql2);

            #redirect to manage category with message
            //check whether executed or not
            if ($res) {
                $_SESSION['update-category'] = "<div class='success'>Successfully Update Category</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['update-category'] = "<div class='failure'>Failed to Update Category</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            }
        }
        ?>
        <!-- Add Category From Starts -->

    </div>
</div>


<?php include('./partials/footer.php'); ?>