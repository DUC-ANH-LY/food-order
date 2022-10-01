<?php include('./partials/menu.php'); ?>
<?php
$id = $_GET['id'];
if (isset($id)) {
    $sql = "SELECT * FROM tbl_food WHERE id= '$id'";
    $res = mysqli_query($conn, $sql);
    $count  = mysqli_num_rows($res);
    if ($count == 1) {
        $rows = mysqli_fetch_assoc($res);
        $title = $rows['title'];
        $price = $rows['price'];
        $description = $rows['description'];
        $current_image = $rows['image_name'];
        $featured = $rows['featured'];
        $active = $rows['active'];
    } else {
        $_SESSION['no-food-found'] = "<div class='failure'>Food not found</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else header('location:' . SITEURL . 'admin/manage-food.php');

// if (isset($_SESSION['no-update-category'])) {
//     echo $_SESSION['no-update-category'];
//     unset($_SESSION['no-update-category']);
// }
// if (isset($_SESSION['upload'])) {
//     echo $_SESSION['upload'];
//     unset($_SESSION['upload']);
// }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <!-- Update Category From Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" placeholder="Description of Food" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>

                            <img src="../images/food/<?php echo $current_image; ?>" width="100px">

                        <?php
                        } else {
                            echo "<div class='failure'>Image not Added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            // query to get active category
                            $sql = "SELECT * FROM tbl_category WHERE active ='Yes'";
                            // execute query 
                            $res = mysqli_query($conn, $sql);
                            //count rows
                            $count = mysqli_num_rows($res);
                            if ($count) {
                                //category available
                                while ($rows = mysqli_fetch_assoc($res)) {
                                    $category_title = $rows['title'];
                                    $category_id = $rows['id'];
                            ?>
                                    <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                                }
                            } else {
                                // category  not available
                                ?>
                                <option value=" 0">Category not available</option>
                            <?php
                            }




                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if ($featured == 'Yes') echo 'checked'; ?>>Yes
                        <input type="radio" name="featured" value="No" <?php if ($featured == 'No') echo 'checked'; ?>>No
                    </td>
                </tr>


                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if ($active == 'Yes') echo 'checked'; ?>>Yes
                        <input type="radio" name="active" value="No" <?php if ($active == 'No') echo 'checked'; ?>>No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php


        if (isset($_POST['submit'])) {
            // echo "button click!"
            // 1.get all data from form 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];


            //2. upload file image if selected
            if (isset($_FILES['image']['name'])) {
                //upload button cliecked 
                $image_name = $_FILES['image']['name']; //new image name
                // check if image is available or not 
                if ($image_name != "") {
                    // img is available, then we come to upload to local file

                    $ext = end(explode('.', $image_name)); // extract extension for image file such as (png,jpeg,..)
                    $image_name = 'Food-Name_' . rand(0000, 9999) . '.' . $ext; //create new img_name
                    $source = $_FILES['image']['tmp_name']; // get source img file  (source)
                    $des = '../images/food/' . $image_name; // path file to store in local machine (destination)

                    $upload = move_uploaded_file($source, $des);  // upload file
                    // check for upload selected image successfull or not
                    if (!$upload) {
                        //  message to announcement
                        $_SESSION['upload'] = "<div class='failure'>Failed to upload image.</div>";
                        // redirect
                        header('location:' . SITEURL . '/admin/manage-food.php');
                        // end process
                        die();
                    }

                    // remove curernt image
                    if ($current_image != "") {
                        //current img is available
                        $des = '../images/food/' . $current_image;

                        $remove = unlink($des);
                        // check whether image is removed or not
                        //if failed to remove then display the message and stop the process
                        if (!$remove) {
                            //failed to remove image
                            $_SESSION['failed-remove'] = "<div class='failure'>Failed to remove current image.</div>";
                            header('location:' . SITEURL . '/admin/manage-food.php'); //redirect
                            die(); //stop process
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }




            //3.Update to database
            // SQL query and update to database
            $sql2 = "UPDATE tbl_food SET 
                title='$title',
                description='$description',
                price='$price',
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'
                WHERE id='$id'
            ";
            // excute the query
            $res3 = mysqli_query($conn, $sql2);

            #redirect to manage category with message
            //check whether executed or not
            if ($res3) {
                $_SESSION['update-food'] = "<div class='success'>Successfully Update Food</div>";
                header("location:" . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['update-food'] = "<div class='failure'>Failed to Update Food</div>";
                header("location:" . SITEURL . 'admin/manage-food.php');
            }
        }
        ?>
        <!-- Add Category From Starts -->

    </div>
</div>


<?php include('./partials/footer.php'); ?>