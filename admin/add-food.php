<?php include('partials/menu.php'); ?>
<!-- Menu Section Ends -->

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <!-- Add Food From Starts -->
        <?php
        if (isset($_SESSION['failed-to-upload-image'])) {
            echo $_SESSION['failed-to-upload-image'];
            unset($_SESSION['failed-to-upload-image']);
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
                    <td>Description: </td>
                    <td>
                        <textarea name="description" placeholder="Description of Food" cols="30" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Select Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            //php code to display categories from database 
                            //1. Create SQL to get all active categories from database    
                            $sql = "SELECT * FROM tbl_category  WHERE active ='Yes'";
                            //execute query
                            $res = mysqli_query($conn, $sql);
                            // check whether it exits or not 
                            $count = mysqli_num_rows($res);
                            if ($count) {
                                while ($rows = mysqli_fetch_assoc($res)) {
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                            ?>
                                    <option value="<?php echo $id ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No category Found</option>
                            <?php
                            }
                            ?>
                            <option value="1">Food</option>
                            <option value="2">Snacks</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Add Food From Starts -->
        <?php
        // check whether  the button is clicked or not    
        if (isset($_POST['submit'])) {
            // add food to the database
            //1. get data form 
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];


            // check whether radio button is clicked or not
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            //2. Upload file to local file
            //see the object return 
            // print_r($_FILES['image']);

            if (isset($_FILES['image']['name'])) {
                // get detailed of selected image
                $image_name = $_FILES['image']['name'];
                // check whether the image is selected or not and upload image if selected
                if ($image_name != "") {
                    // image is selected 
                    // A. Rename the image 
                    // get the extension of selected image (jpg,png,gif,...)
                    echo $image_name;
                    $ext = end(explode('.',$image_name));
                    // create new name for image 
                    $image_name = 'Food-Name-' . rand(0000, 9999) . "." . $ext;
                    // source the current location of img
                    $source = $_FILES['image']['tmp_name'];
                    // destinatioin of img uploaded
                    $des = '../images/food/' . $image_name;
                    // check whether img uploader or not
                    if (!move_uploaded_file($source, $des)) {
                        // create  the message  to pop up
                        $_SESSION['failed-to-upload-image'] = "<div class='failure'>Failed to Upload Image</div>";
                        // redirect the page 
                        header('location:' . SITEURL . 'admin/add-food.php');
                        // end procees
                        die();
                    }
                } else {
                    $image_name = "";// setting dafault value as blank
                }
            }
            //3. Insert in the Table    
            // create a sql query to save or add food 

            $sql= "INSERT INTO tbl_food SET 
                title = '$title',
                description = '$description',
                price = '$price',
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
            ";
            // execute query 

            $res = mysqli_query($conn,$sql);
            if($res) {
                $_SESSION['add-food'] = "<div class='success'>Add Food success</div>";
                        // redirect the page 
                header('location:' . SITEURL . 'admin/manage-food.php');
                        // end procees
                die();
            }
            else
            {
                $_SESSION['add-food'] = "<div class='failure'>Add Food Failed</div>";
                // redirect the page 
                header('location:' . SITEURL . 'admin/manage-food.php');
                    // end procees
                 die();
            }

        }





        ?>

    </div>
</div>
<!-- Main Content Section Ends -->

<!-- Footer Section Starts -->
<?php include('partials/footer.php'); ?>