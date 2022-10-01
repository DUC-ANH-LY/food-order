<?php include('partials/menu.php'); ?>
<!-- Menu Section Ends -->

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }


        ?>
        <table class="tbl-full">
            <tr>
                <th>Id</th>
                <th>Food</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>

            <?php
            //query to get all data from database
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //display latest order at first 
            //Execute query 
            $res = mysqli_query($conn, $sql);
            $s = 1;
            //count the rows 
            $count = mysqli_num_rows($res);
            if ($count) {
                //order available
                while ($rows = mysqli_fetch_assoc($res)) {
                    //get all the order information
                    $id = $rows['id'];
                    $food = $rows['food'];
                    $price = $rows['price'];
                    $qty = $rows['qty'];
                    $total = $rows['total'];
                    $order_date = $rows['order_date'];
                    $status = $rows['status'];
                    $customer_name = $rows['customer_name'];
                    $customer_contact = $rows['customer_contact'];
                    $customer_email = $rows['customer_email'];
                    $customer_address = $rows['customer_address'];
            ?>
            <tr>
                <td><?php echo $s++; ?></td>
                <td><?php echo $food; ?></td>
                <td><?php echo $qty; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $total; ?></td>
                <td><?php echo $order_date; ?></td>
                <td><?php
                            //order,on delivery,delivered , cancelled
                            if ($status == "Ordered") {
                                echo "<lable>$status</lable>";
                            } else if ($status == "On Delivery") {
                                echo "<lable style='color:orange;'>$status</lable>";
                            } else if ($status == "Delivered") {
                                echo "<lable style='color:green;'>$status</lable>";
                            } else if ($status == "Cancelled") {
                                echo "<lable style='color:red;'>$status</lable>";
                            }





                            ?></td>
                <td><?php echo $customer_name; ?></td>
                <td><?php echo $customer_contact; ?></td>
                <td><?php echo $customer_email; ?></td>
                <td><?php echo $customer_address; ?></td>
                <td>
                    <a href="update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                    <!-- <a href="<?php echo SITEURL; ?>/admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                        class="btn-danger">Delete Food</a> -->
                </td>
            </tr>
            <?php

                }
            } else {
                echo "<tr>
                <td colspan='12' class='failure'> Orders not Available</td>
            </tr>";
            }



            ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<!-- Footer Section Starts -->
<?php include('partials/footer.php'); ?>