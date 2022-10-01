<?php include('./partials-front/menu.php'); ?>
<!-- Navbar Section Ends Here -->



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php

        // create sql query to display category from database
        $sql = "SELECT * FROM tbl_category WHERE active = 'Yes '";

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

        <a href="category-foods.php">
            <div class="box-3 float-container">
                <?php
                        if ($image_name != "") {
                        ?> <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" alt="Pizza"
                    class="img-responsive img-curve">
                <?php
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
</section>
<!-- Categories Section Ends Here -->


<?php include('./partials-front/footer.php'); ?>