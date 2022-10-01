<?php include('./partials/menu.php'); ?>




<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <!-- Update Order From Starts -->
        <?php
        // check whether id is set or not
        if (isset($_GET['id'])) {
            //get order details
            $id = $_GET['id'];
            // get all other details based on this id 
            // sql query to get all data
            $sql = " SELECT * FROM tbl_order WHERE id='$id'";

            // Execute query
            $res = mysqli_query($conn, $sql);
            // count rows
            $count = mysqli_num_rows($res);
            //check whether data is available or not
            // count variable 
            if ($count == 1) {
                //data available 
                $rows = mysqli_fetch_assoc($res);
                $food = $rows['food'];
                $price = $rows['price'];
                $qty = $rows['qty'];
                $status = $rows['status'];
                $customer_name = $rows['customer_name'];
                $customer_contact = $rows['customer_contact'];
                $customer_email = $rows['customer_email'];
                $customer_address = $rows['customer_address'];
            } else {
                //not have data
                //redirect 
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        } else {
            //redirect
            header('location:' . SITEURL . 'admin/manage-order.php');
        }





        ?>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name: </td>
                    <td>
                        <?php echo $food ?>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <b>$<?php echo $price ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Qty: </td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty ?>">
                    </td>
                </tr>


                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Ordered") {
                                        echo "selected";
                                    }   ?>value="Ordered">Ordered
                            <option <?php if ($status == "On Delivery") {
                                        echo "selected";
                                    }   ?>value="On Delivery">
                                On Delivery
                            <option <?php if ($status == "Delivered") {
                                        echo "selected";
                                    }   ?>value="Delivered">Delivered
                            <option <?php if ($status == "Cancelled") {
                                        echo "selected";
                                    }   ?>value="Cancelled">Cancelled
                            </option>


                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea name="customer_address" id="" cols="30"
                            rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        //check where update button is clicked or not
        if (isset($_POST['submit'])) {
            // get all value from form 
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_email = $_POST['customer_email'];
            $customer_contact = $_POST['customer_contact'];

            // update the value
            $sql2 = "UPDATE  tbl_order SET 
                qty ='$qty',
                total ='$total',
                status ='$status',
                customer_name ='$customer_name',
                customer_contact ='$customer_contact'
                WHERE id='$id'
            
            
            ";
            //execute query 
            $res2 = mysqli_query($conn, $sql2);

            //and redirect to manage order with message
            if ($res2) {
                $_SESSION['update'] = "<div class='success'>Order update successfull</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            } else {
                $_SESSION['update'] = "<div class='failure'>Order update unsuccessfull</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        }




        ?>





    </div>
</div>


<?php include('./partials/footer.php'); ?>