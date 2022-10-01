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
<?php

if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}



?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php

        // create sql query to display category from database
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured = 'Yes' LIMIT 3";

        // Execute query 
        $res = mysqli_query($conn, $sql);

        // count rows to check whether database have category or not
        $count = mysqli_num_rows($res);

        // check if it have some category in database
        if ($count) {
            // have category in database
            while ($rows = mysqli_fetch_assoc($res)) {
                // get id,title and image_name
                $id = $rows['id'];
                $title = $rows['title'];
                $image_name =  $rows['image_name'];
        ?>
        <!-- display that information by using html + php  -->

        <a href="category-foods.php?category_id=<?php echo $id; ?>">
            <div class="box-3 float-container">
                <?php
                        if ($image_name != "") {
                        ?> <img src=" <?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" alt="Pizza"
                    class="img-responsive img-curve"><?php
                                                                                                                                                } else {
                                                                                                                                                    echo "<div class='failure'> Image not added</div>";
                                                                                                                                                }

                                                                                                                                                    ?>

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
        </a>





        <?php


            }
        } else {
            echo "<div class='failure'> Category is not added</div> ";
        }


        ?>


        <div class="clearfix"></div>



    </div>
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
            if ($count > 0) {
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
                    <p class="food-price">$<?php echo $price ?></p>
                    <p class="food-detail">
                        <?php echo $description ?>
                    </p>
                    <br>

                    <a href="order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>



            <?php


                }
            } else {
                // food not available
                echo "<div class='failure'> Food is not added</div> ";
            }


            ?>


            <div class="clearfix"></div>



        </div>
        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('./partials-front/footer.php'); ?>