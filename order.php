<?php include('./partials-front/menu.php'); ?>
<?php
// check whether food id is set or not 
if (isset($_GET['food_id'])) {
    //get the food id and detailed of selected food
    $food_id = $_GET['food_id'];
    // sql query to get data from database
    $sql = "SELECT * FROM tbl_food WHERE id='$food_id'";
    // execute query 
    $res = mysqli_query($conn, $sql);
    //count rows 
    $count = mysqli_num_rows($res);
    if ($count) {
        // food availabale 
        $rows = mysqli_fetch_assoc($res);
        $id = $rows['id'];
        $title = $rows['title'];
        $price = $rows['price'];
        $image_name = $rows['image_name'];
    } else {
        header('location:' . SITEURL);
    }
} else {
    //redirect to homepage
    header('location:' . SITEURL);
}


?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    // check whether image is available or not
                    if ($image_name != "") {
                        // have the image
                    ?>

                    <img src="images/food/<?php echo $image_name ?>" alt="Chicke Hawain Pizza"
                        class="img-responsive img-curve">
                    <?php } else {
                        // image not available
                        echo "<div class='failure'> Image Not Added</div>";
                    } ?>

                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">



                    <in <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="ly duc anh" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="0988xxxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="namobilegame@gmail.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                    required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>
        <?php
        // check whether submit or not
        if (isset($_POST['submit'])) {
            // submit clicked 
            //get data from form submmited
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            // get total price
            $total = $price * $qty;
            $order_date = date("Y-m-d h:i:sa"); //order date
            $status = "Ordered"; //Ordered,On delivery ,delivered,cancelled

            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];


            //save the Order in database
            // create sql query to save the data
            $sql = "INSERT INTO tbl_order SET
                food='$food',
                price='$price',
                qty='$qty',
                total='$total',
                order_date='$order_date',
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'
            ";

            // execute query
            $res = mysqli_query($conn, $sql);
            if ($res) {
                // query success
                $_SESSION['order'] = "<div class='success center'>Food Ordered Successfully.</div>";
                header('location:' . SITEURL);
            } else {
                $_SESSION['order'] = "<div class='failure center' >Food Ordered Unsuccessfully.</div>";
                header('location:' . SITEURL);
            }
        }




        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('./partials-front/footer.php'); ?>