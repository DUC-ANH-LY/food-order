<?php include('./partials-front/menu.php'); ?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $_POST['search'];?>"</a>
        </h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        //get the search keyword    
        $search = $_POST['search'];
        //sql query to get foods based on search keyword 
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description  LIKE '%search%'";

        //Execute the query 
        $res = mysqli_query($conn, $sql);

        // Count Rows 
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            // Food Available
            while ($rows  = mysqli_fetch_assoc($res)) {
                $id = $rows['id'];
                $title = $rows['title'];
                $price = $rows['price'];
                $image_name = $rows['image_name'];
                $description = $rows['description'];

        ?>
        <div class="food-menu-box">
            <div class="food-menu-img">
                <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt=""
                    class="img-responsive img-curve">
            </div>

            <div class="food-menu-desc">
                <h4><?php echo $title; ?></h4>
                <p class="food-price">$<?php echo $price; ?></p>
                <p class="food-detail">
                    <?php echo $description; ?>
                </p>
                <br>

                <a href="#" class="btn btn-primary">Order Now</a>
            </div>
        </div>

        <?php





            }
        }


        ?>


        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('./partials-front/footer.php'); ?>