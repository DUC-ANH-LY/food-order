<?php include('partials/menu.php'); ?>
<!-- Menu Section Ends -->

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br><br>
        <?php
        if (isset($_SESSION['add-category'])) {
            echo $_SESSION['add-category'];
            unset($_SESSION['add-category']);
        }
        if (isset($_SESSION['update-category'])) {
            echo $_SESSION['update-category'];
            unset($_SESSION['update-category']);
        }

        if (isset($_SESSION['failed-remove'])) {
            echo  $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        if (isset($_SESSION['delete-success'])) {
            echo  $_SESSION['delete-success'];
            unset($_SESSION['delete-success']);
        }
        if (isset($_SESSION['delete-failed'])) {
            echo  $_SESSION['delete-failed'];
            unset($_SESSION['delete-failed']);
        }

        ?>
        <a href="add-category.php" class='btn-primary'>Add Catagory</a>
        <table class="tbl-full">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Image Name</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $count = mysqli_num_rows($res);
                $s = 1;
                if ($count) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];
            ?>

                        <tr>
                            <td><?php echo $s++; ?>. </td>
                            <td><?php echo $title;  ?></td>
                            <td>
                                <?php
                                if ($image_name != "") {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width='100px'>
                                <?php
                                } else {
                                    echo "<div class='failure'>Image Not Added</div>";
                                }

                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>/admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                <a href="<?php echo SITEURL; ?>/admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                }
            }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<!-- Footer Section Starts -->
<?php include('partials/footer.php'); ?>