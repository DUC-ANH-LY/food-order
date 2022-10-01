<?php include('partials/menu.php'); ?>
<!-- Menu Section Ends -->

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br><br>
        <?php
        if (isset($_SESSION['add-food'])) {
            echo $_SESSION['add-food'];
            unset($_SESSION['add-food']);
        }
        if (isset($_SESSION['delete-success'])) {
            echo $_SESSION['delete-success'];
            unset($_SESSION['delete-success']);
        }
        if (isset($_SESSION['delete-failed'])) {
            echo $_SESSION['delete-failed'];
            unset($_SESSION['delete-failed']);
        }
        if (isset($_SESSION['no-food-found'])) {
            echo  $_SESSION['no-food-found'];
            unset($_SESSION['no-food-found']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        if (isset($_SESSION['update-food'])) {
            echo $_SESSION['update-food'];
            unset($_SESSION['update-food']);
        }
        ?>
        <a href="add-food.php" class='btn-primary'>Add Food</a>
        <table class="tbl-full">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_food";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $count = mysqli_num_rows($res);
                $s = 1;
                if ($count) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $price = $rows['price'];
                        $image_name = $rows['image_name'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];
            ?>

                        <tr>
                            <td><?php echo $s++; ?>. </td>
                            <td><?php echo $title;  ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                                <?php
                                if ($image_name != "") {
                                ?>
                                    <img src="../images/food/<?php echo $image_name; ?>" width='100px'>
                                <?php
                                } else {
                                    echo "<div class='failure'>Image Not Added</div>";
                                }

                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>/admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                <a href="<?php echo SITEURL; ?>/admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='failure'>Food not added</td><tr>";
                }
            }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<!-- Footer Section Starts -->
<?php include('partials/footer.php'); ?>