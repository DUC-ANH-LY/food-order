<?php include('./partials-front/menu.php'); ?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

// create sql query to display food from database
//sql query 
$sql = "SELECT * FROM tbl_food WHERE active='Yes' AND featured = 'Yes' LIMIT 6";

// Execute query 
$res = mysqli_query($conn, $sql);

// count rows to check whether database have food or not
$count = mysqli_num_rows($res);

// check if it have some food in database
if ($count>0) {
    // have food in database
    while ($rows = mysqli_fetch_assoc($res)) {
        // get id,title,price,description and  and image_name
        $id = $rows['id'];
        $title = $rows['title'];
        $price = $rows['price'];
        $description = $rows['description'];
        $image_name =  $rows['image_name'];
?>
        <!-- display that information by using html + php  -->

        <div class="food-menu-box">
            <div class="food-menu-img">
                <?php
                //check whether image_name is available
                if ($image_name != "") {
                    // avalaible
                ?>
                <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt=""
                    class="img-responsive img-curve">
                <?php
                } else {
                    echo "<div class = ' failure'> Food Image not added </div>";
                }
                ?>
            </div>

            <div class=" food-menu-desc">
                <h4><?php echo $title ?></h4>
                <p class="food-price"><?php echo $price ?></p>
                <p class="food-detail">
                    <?php echo $description ?>
                </p>
                <br>

                <a href="#" class="btn btn-primary">Order Now</a>
            </div>
        </div>



        <?php


    }
} else {
    // food not available
    echo "<div class='failure'> Food is not added</div> ";
}


?>



        <div class=" clearfix">
        </div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('./partials-front/footer.php'); ?>