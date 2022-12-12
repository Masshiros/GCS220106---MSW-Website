<?php
$active = 'Shop';
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
            <?php
            if(!isset($_GET['p_cat'])){
                echo'<div class="box">
                <!-- box Begin -->
                <h1>Shop</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo deleniti accusamus,
                    consequuntur illum quasi ut. Voluptate a, ipsam repellendus ut fugiat minima? Id facilis itaque
                    autem, officiis veritatis perferendis, quaerat!
                </p>
            </div><!-- box Finish -->';
            };
            
            ?>


            <div class="row">
                <!-- row Begin -->
                <?php
                // 6 products per page
                $LIMIT = 6;
                if(!isset($_GET['p_cat'])){
                    //check if page exist --> if not --> page = 1
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                               
                    }else{
                          $page = 1;
                    };
                    // formula to do pagination
                    $begin_product = ((int)$page-1)*$LIMIT;
                    $sql = "select * from product order by productID ASC limit $begin_product , $LIMIT";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                     // formula to get the begin index product with page and limit
                    while($row = $stmt->fetch()){
                        $id = $row['productID'];
                        $name = $row['productName'];
                        $image = $row['productImage'];
                        $price = $row['productPrice'];
                        echo
                    "
                    <div class='col-md-4 col-sm-6 center-responsive'>
                        <form action='cart.php?act=add_cart&pro_id=$id' method='POST'>
                            <div class='product'>

                        <a href='details.php?pro_id=$id'>
                            <img class='img-responsive' src='../image/products/$image ' alt='Product 1'>
                        </a>
                        <div class='text'>
                            <!-- text Begin -->
                            <h3>
                                <a href='details.php?pro_id=$id'>$name </a>
                            </h3>
                            <p class='price'> $price</p>
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
                        <input type='hidden' name='productName' value='$name'>
                        <input type='hidden' name='productImage' value='$image'>
                        <input type='hidden' name='productPrice' value='$price'>
                        <input type='hidden' name='productID' value='$id'>
                    </form>
                    </div>
                    </div>
                ";
                }
                                }
                ?>
            </div><!-- col-md-9 Finish -->
            <?php if(!isset($_GET['p_cat'])){  ?>
            <nav aria-label="Page navigation example" class="text-center">
                <ul class="pagination">
                    <?php
                    $sql = "select * from product";
                    $stmt = $conn->query($sql);
                    $stmt->execute();
                    $row_count = $stmt->rowCount();
                    $pages = ceil($row_count / $LIMIT );
                            echo "
                            <li> 
                                <a href='shop.php?page=1'>First Page</a>
                            </li>
                            ";
                            for($i=1 ; $i <= $pages; $i++){
                                echo "
                                <li> 
                                    <a href='shop.php?page=".$i."'>".$i."</a>
                                </li>
                                ";
                        
                                
                            }
                            echo "
                            <li> 
                                <a href='shop.php?page=".$pages."'>Last Page</a>
                            </li>
                            ";
                    ?>
                </ul>
            </nav>
            <?php  }?>
            <div class="row">
                <?php getCatPro($conn); ?>
            </div>


        </div><!-- container Finish -->
    </div><!-- #content Finish -->

    <?php 
    
    include("includes/footer.php");
    
?>

    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>





    </body>

    </html>