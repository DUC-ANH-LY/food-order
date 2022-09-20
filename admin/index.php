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
                     <h1>5</h1>
                     Category
                 </div>
                 <div class="col-4 text-center">
                     <h1>5</h1>
                     Category
                 </div>
                 <div class="col-4 text-center">
                     <h1>5</h1>
                     Category
                 </div>
                 <div class="col-4 text-center">
                     <h1>5</h1>
                     Category
                 </div>
                 </div>
            </div>
        </div>
       <!-- Main Content Section Ends -->

       <!-- Footer Section Starts -->
 <?php include('./partials/footer.php'); ?>