<?php
$active = 'Home';
include("includes/header.php");
?>
<div class="container" id="slider">
    <!-- container Begin -->

    <div class="col-md-12">
        <!-- col-md-12 Begin -->

        <div class="carousel slide" id="myCarousel" data-ride="carousel">
            <!-- carousel slide Begin -->

            <ol class="carousel-indicators">
                <!-- carousel-indicators Begin -->

                <li class="active" data-target="#myCarousel" data-slide-to="0"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>


            </ol><!-- carousel-indicators Finish -->

            <div class="carousel-inner">
                <!-- carousel-inner Begin -->

                <div class="item active">

                    <img src="../image/slider/slider1.jpg" alt="Slider Image 1">

                </div>

                <div class="item">

                    <img src="../image/slider/slider2.jpg" alt="Slider Image 2">

                </div>

                <div class="item">

                    <img src="../image/slider/slider3.jpg" alt="Slider Image 3">

                </div>



            </div><!-- carousel-inner Finish -->

            <a href="#myCarousel" class="left carousel-control" data-slide="prev">
                <!-- left carousel-control Begin -->

                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>

            </a><!-- left carousel-control Finish -->

            <a href="#myCarousel" class="right carousel-control" data-slide="next">
                <!-- left carousel-control Begin -->

                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>

            </a><!-- left carousel-control Finish -->

        </div><!-- carousel slide Finish -->

    </div><!-- col-md-12 Finish -->

</div><!-- container Finish -->

<div id="advantages">
    <!-- #advantages Begin -->

    <div class="container">
        <!-- container Begin -->

        <div class="same-height-row">
            <!-- same-height-row Begin -->

            <div class="col-sm-4">
                <!-- col-sm-4 Begin -->

                <div class="box same-height">
                    <!-- box same-height Begin -->

                    <div class="icon">
                        <!-- icon Begin -->

                        <i class="fa fa-heart"></i>

                    </div><!-- icon Finish -->

                    <h3><a href="#">Best Offer</a></h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>

                </div><!-- box same-height Finish -->

            </div><!-- col-sm-4 Finish -->

            <div class="col-sm-4">
                <!-- col-sm-4 Begin -->

                <div class="box same-height">
                    <!-- box same-height Begin -->

                    <div class="icon">
                        <!-- icon Begin -->

                        <i class="fa fa-tag"></i>

                    </div><!-- icon Finish -->

                    <h3><a href="#">Best Prices</a></h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

                </div><!-- box same-height Finish -->

            </div><!-- col-sm-4 Finish -->

            <div class="col-sm-4">
                <!-- col-sm-4 Begin -->

                <div class="box same-height">
                    <!-- box same-height Begin -->

                    <div class="icon">
                        <!-- icon Begin -->

                        <i class="fa fa-thumbs-up"></i>

                    </div><!-- icon Finish -->

                    <h3><a href="#">100% Original</a></h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

                </div><!-- box same-height Finish -->

            </div><!-- col-sm-4 Finish -->

        </div><!-- same-height-row Finish -->

    </div><!-- container Finish -->

</div><!-- #advantages Finish -->
<div id="hot">
    <!-- #hot Begin -->
    <div class="box">
        <!-- box Begin -->

        <div class="container">
            <!-- container Begin -->

            <div class="col-md-12">
                <!-- col-md-12 Begin -->
                <h2>
                    Our Latest Products
                </h2>

            </div><!-- col-md-12 Finish -->

        </div><!-- container Finish -->

    </div><!-- box Finish -->

</div><!-- #hot Finish -->

<div id="content" class="container">
    <!-- container Begin -->

    <div class="row">
        <!-- row Begin -->
        <!-- col-sm-4 col-sm-6 single Finish -->
        <?php while($row = $stmt->fetch()) {
            // fetch data from product database to home page and generate product display
            $id = $row['productID'];
            $name = $row['productName'];
            $image = $row['productImage'];
            $price = $row['productPrice'];
            echo"
        <div class='col-md-4 col-sm-6 single'>
            <form action='cart.php?act=add_cart&pro_id=$id' method='POST'>
                <div class='product'>
                        <a href='details.php?pro_id=$id'>
                 <img class='img-responsive' src='../image/products/$image' alt='Product 1'>
                    </a>
                    <div class='text'>
                        <h3>
                            <a href='details.php?pro_id=$id'>
                                $name
                            </a>
                        </h3>
                    <p class='price'>$price</p>
                    <p class='button'>
                        <a href='details.php?pro_id=$id' class='btn btn-default'>View Details</a>
                        <button type='submit' value='buyproduct' name='addtocart' class='btn btn-primary'>
                            <a href='cart.php'>
                                <i class='fa fa-shopping-cart'>
                            Add To Cart
                                </i>
                            </a>
                        </button>
                    </p>
                    </div>
                </div>
                <input type='hidden' name='productName' value='$name'>
                <input type='hidden' name='productImage' value='$image'>
                <input type='hidden' name='productPrice' value='$price'>
                <input type='hidden' name='productID' value='$id'>
            </form>
        </div>
        ";
} ?>
    </div>

</div>
<?php 
    
    include("includes/footer.php");
    
    ?>
<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>


</body>

</html>