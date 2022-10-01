<?php include('./partials/menu.php'); ?>
<!-- Menu Section Ends -->

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <strong>DASHBOARD</strong>
        <div class="flex">
            <div class="col-4 text-center">

                <?php
                //sql query 
                $sql = "SELECT * FROM tbl_category";

                //execute query 
                $res = mysqli_query($conn, $sql);
                //count rows
                $count = mysqli_num_rows($res);
                ?>
                <h1>

                    <?php echo                     $count; ?>


                </h1>
                Category
            </div>
            <div class="col-4 text-center">
                <?php
                //sql query 
                $sql1 = "SELECT * FROM tbl_food";

                //execute query 
                $res1 = mysqli_query($conn, $sql1);
                //count rows
                $count1 = mysqli_num_rows($res1);
                ?>
                <h1><?php echo $count1; ?></h1>
                Foods
            </div>
            <div class="col-4 text-center">
                <?php
                //sql query 
                $sql2 = "SELECT * FROM tbl_order";

                //execute query 
                $res2 = mysqli_query($conn, $sql2);
                //count rows
                $count2 = mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2 ?></h1>
                Total Order
            </div>
            <div class="col-4 text-center">
                <?php
                //create sql query to get total revenue generated 
                // aggregate function in sql
                $sql4 = "SELECT SUM(total) AS Total FROM  tbl_order";

                //execute query 
                $res4 = mysqli_query($conn, $sql4);
                // get the value
                $row = mysqli_fetch_assoc($res4);
                //count rows
                $total_revenue = $row['Total'];
                ?>
                <h1>$<?php echo $total_revenue; ?></h1>
                Category
            </div>
        </div>
    </div>
</div>
<!-- Main Content Section Ends -->

<!-- Footer Section Starts -->
<?php include('./partials/footer.php'); ?>