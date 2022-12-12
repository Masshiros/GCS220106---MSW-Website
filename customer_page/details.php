<?php
$active ='';
include("includes/header.php");
?>

<div id="content">
    <!-- #content Begin -->
    <div class="container">
        <!-- container Begin -->
        <div class="col-md-12">
            <!-- col-md-12 Begin -->

            <ul class="breadcrumb">
                <!-- breadcrumb Begin -->
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    Shop
                </li>
                <li>
                    <a href="shop.php?p_cat=<?php echo $row_cat['categoryID']?>">
                        <?php echo $row_cat['categoryName'];?>
                    </a>
                </li>
                <li>
                    <?php echo $row_product['productName'];?>
                </li>
            </ul><!-- breadcrumb Finish -->

        </div><!-- col-md-12 Finish -->

        <div class="col-md-3">
            <!-- col-md-3 Begin -->

            <?php 
    
    include("includes/sidebar.php");
    
    ?>

        </div><!-- col-md-3 Finish -->

        <div class="col-md-9">
            <!-- col-md-9 Begin -->
            <div id="productMain" class="row">
                <!-- row Begin -->
                <div class="col-sm-6">
                    <!-- col-sm-6 Begin -->
                    <div id="mainImage">
                        <!-- #mainImage Begin -->
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- carousel slide Begin -->
                            <ol class="carousel-indicators">
                                <!-- carousel-indicators Begin -->
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol><!-- carousel-indicators Finish -->

                            <div class="carousel-inner">
                                <div class="item active ">
                                    <center><img class="img-responsive "
                                            src="../image/products/<?=$row_product['productImage']?>" alt="Product 3-a">

                                    </center>
                                </div>
                                <div class="item ">
                                    <center><img class="img-responsive "
                                            src="../image/products/<?=$row_product['productImage']?>" alt="Product 3-b">

                                    </center>
                                </div>
                                <div class="item ">
                                    <center><img class="img-responsive "
                                            src="../image/products/<?=$row_product['productImage']?>" alt="Product 3-c">

                                    </center>
                                </div>
                            </div>

                            <a href="#myCarousel" class="left carousel-control" data-slide="prev">
                                <!-- left carousel-control Begin -->
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a><!-- left carousel-control Finish -->

                            <a href="#myCarousel" class="right carousel-control" data-slide="next">
                                <!-- right carousel-control Begin -->
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Previous</span>
                            </a><!-- right carousel-control Finish -->

                        </div><!-- carousel slide Finish -->
                    </div><!-- mainImage Finish -->
                </div><!-- col-sm-6 Finish -->

                <div class="col-sm-6">
                    <!-- col-sm-6 Begin -->
                    <div class="box">
                        <!-- box Begin -->
                        <form action="cart.php?act=add_cart&pro_id=<?php echo $row_product['productID']?>"
                            class="form-horizontal" method="POST">
                            <h1 class="text-center">
                                <?php echo $row_product['productName']; ?>
                            </h1>

                            <!-- form-horizontal Begin -->
                            <div class="form-group">
                                <!-- form-group Begin -->
                                <label for="" class="col-md-5 control-label">Products Quantity</label>

                                <div class="col-md-7">
                                    <!-- col-md-7 Begin -->
                                    <select name="count" id="" class="form-control">
                                        <!-- select Begin -->
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select><!-- select Finish -->

                                </div><!-- col-md-7 Finish -->

                            </div><!-- form-group Finish -->



                            <p class=" price">
                                <?php echo $row_product['productPrice'] ;?>
                            </p>

                            <button type='submit' value='buyproduct' name='addtocart'
                                class='btn btn-primary d-block mx-auto' style='display:block; margin:auto;'>
                                <a href='cart.php'>
                                    <i class='fa fa-shopping-cart'>
                                        Add To Cart
                                    </i>
                                </a>
                            </button>
                            <input type='hidden' name='productName' value='<?php echo $row_product["productName"];?>'>
                            <input type='hidden' name='productImage' value='<?php echo $row_product["productImage"];?>'>
                            <input type='hidden' name='productPrice' value='<?php echo $row_product["productPrice"];?>'>
                            <input type='hidden' name='productID' value='<?php echo $row_product["productID"];?>'>
                        </form><!-- form-horizontal Finish -->

                    </div><!-- box Finish -->

                    <div class="row" id="thumbs">
                        <!-- row Begin -->

                        <div class="col-xs-4 ">
                            <!-- col-xs-4 Begin -->
                            <a href="#" class="thumb">
                                <!-- thumb Begin -->
                                <img src="../image/products/<?=$row_product['productImage']?>" alt="product 1"
                                    class="img-responsive">

                            </a><!-- thumb Finish -->
                        </div><!-- col-xs-4 Finish -->

                        <div class="col-xs-4 ">
                            <!-- col-xs-4 Begin -->
                            <a href="#" class="thumb">
                                <!-- thumb Begin -->
                                <img src="../image/products/<?=$row_product['productImage']?>" alt="product 2"
                                    class="img-responsive">

                            </a><!-- thumb Finish -->
                        </div><!-- col-xs-4 Finish -->

                        <div class="col-xs-4 ">
                            <!-- col-xs-4 Begin -->
                            <a href="#" class="thumb">
                                <!-- thumb Begin -->
                                <img src="../image/products/<?=$row_product['productImage']?>" alt="product 4"
                                    class="img-responsive">

                            </a><!-- thumb Finish -->
                        </div><!-- col-xs-4 Finish -->

                    </div><!-- row Finish -->

                </div><!-- col-sm-6 Finish -->


            </div><!-- row Finish -->

            <div class="box" id="details">
                <!-- box Begin -->

                <h4>Product Details</h4>

                <p>

                    <?php echo $row_product['productDetail'];?>

                </p>



                <hr>

            </div><!-- box Finish -->

            <div id="row same-heigh-row">
                <!-- #row same-heigh-row Begin -->
                <div class="col-md-3 col-sm-6">
                    <!-- col-md-3 col-sm-6 Begin -->
                    <div class="box same-height headline">
                        <!-- box same-height headline Begin -->
                        <h3 class="text-center">Products You Maybe Like</h3>
                    </div><!-- box same-height headline Finish -->
                </div><!-- col-md-3 col-sm-6 Finish -->
                <?php 
                // get 3 random product in database
                $sql_ran_product = "select * from product order by rand() limit 0,3 ";
                $stmt_ran_product = $conn->prepare($sql_ran_product);
                $stmt_ran_product->execute();
                while($row_ran_product = $stmt_ran_product->fetch()){
                    $name = $row_ran_product['productName'];
                    $id = $row_ran_product["productID"];
                    $price =$row_ran_product['productPrice'];
                    $img = $row_ran_product['productImage'];
                    echo "
                        <div class='col-md-3 col-sm-6 center-responsive'>
                            <div class='product same-height'>
                                <a href='details.php?pro_id=$id'>
                                    <img class='img-responsive' src='../image/products/$img' alt='Product 6'>
                                </a>
                                <div class='text'>
                                    <h3><a href='details.php?pro_id=$id'> $name </a></h3>
                                    <p class='price'> $ $price  </p>
            </div>
        </div>
    </div>

    ";

    }
    ?>







            </div><!-- #row same-heigh-row Finish -->

        </div><!-- col-md-9 Finish -->

    </div><!-- container Finish -->
</div><!-- #content Finish -->

<?php 
    
    include("includes/footer.php");
    
    ?>
<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>



</body>

</html>