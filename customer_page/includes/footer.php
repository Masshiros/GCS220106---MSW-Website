<?php 
require_once("db.php");
require_once("./functions/functions.php");
?>
<?php
$sql = 'select * from category';
$stmt = $conn->prepare($sql);
$stmt->execute();
?>
<div id="footer">
    <!-- #footer Begin -->
    <div class="container">
        <!-- container Begin -->
        <div class="row">
            <!-- row Begin -->
            <div class="col-sm-6 col-md-3">
                <!-- col-sm-6 col-md-3 Begin -->

                <h4>Pages</h4>

                <ul>
                    <!-- ul Begin -->
                    <li><a href="cart.php">Shopping Cart</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="customer/my_account.php">My Account</a></li>
                </ul><!-- ul Finish -->

                <hr>

                <h4>User Section</h4>

                <ul>
                    <!-- ul Begin -->
                    <li><a href="login.php">Login</a></li>
                    <li><a href="customer_register.php">Register</a></li>
                </ul><!-- ul Finish -->

                <hr class="hidden-md hidden-lg hidden-sm">

            </div><!-- col-sm-6 col-md-3 Finish -->

            <div class="com-sm-6 col-md-3">
                <!-- col-sm-6 col-md-3 Begin -->

                <h4>Top Products Categories</h4>

                <ul>
                    <!-- ul Begin -->
                    <?php while($row=$stmt->fetch()) {?>
                    <li><a href="#"><?= $row['categoryName']?> </a></li>
                    <?php }?>

                </ul><!-- ul Finish -->

                <hr class="hidden-md hidden-lg">

            </div><!-- col-sm-6 col-md-3 Finish -->

            <div class="col-sm-6 col-md-3">
                <!-- col-sm-6 col-md-3 Begin -->

                <h4>Find Us</h4>

                <p>
                    <!-- p Start -->

                    <strong>MSW</strong>
                    <br />Masshiro

                    <br />0900-0000-00
                    <br />masshiro@gmail.msw.com
                    <br /><strong>MrMasshiro</strong>

                </p><!-- p Finish -->

                <a href="contact.php">Check Our Contact Page</a>

                <hr class="hidden-md hidden-lg">

            </div><!-- col-sm-6 col-md-3 Finish -->

            <div class="col-sm-6 col-md-3">

                <h4>Get The News</h4>

                <p class="text-muted">
                    Dont miss our latest update products.
                </p>

                <form action="" method="post">
                    <!-- form begin -->
                    <div class="input-group">
                        <!-- input-group begin -->

                        <input type="text" class="form-control" name="email">

                        <span class="input-group-btn">
                            <!-- input-group-btn begin -->

                            <input type="submit" value="subscribe" class="btn btn-default">

                        </span><!-- input-group-btn Finish -->

                    </div><!-- input-group Finish -->
                </form><!-- form Finish -->

                <hr>

                <h4>Keep In Touch</h4>

                <p class="social">
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="#" class="fa fa-instagram"></a>
                    <a href="#" class="fa fa-google-plus"></a>
                    <a href="#" class="fa fa-envelope"></a>
                </p>

            </div>
        </div><!-- row Finish -->
    </div><!-- container Finish -->
</div><!-- #footer Finish -->


<div id="copyright">
    <!-- #copyright Begin -->
    <div class="container">
        <!-- container Begin -->
        <div class="col-md-6">
            <!-- col-md-6 Begin -->

            <p class="pull-left">&copy; 2022 MSW Store All Rights Reserve</p>

        </div><!-- col-md-6 Finish -->
        <div class="col-md-6">
            <!-- col-md-6 Begin -->

            <p class="pull-right">Theme by: <a href="#">Masshiro</a></p>

        </div><!-- col-md-6 Finish -->
    </div><!-- container Finish -->
</div><!-- #copyright Finish -->