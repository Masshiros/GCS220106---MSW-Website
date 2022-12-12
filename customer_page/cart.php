<?php
$active='Cart';
include("includes/header.php");
?>
<?php

if(isset($_GET['act']) && $_GET['act'] == 'delete_cart'){
    if(isset($_GET['i']) && ($_GET['i']) >= 0){
        if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            array_splice($_SESSION['cart'],$_GET['i'],1);
            echo '<script>window.open("cart.php","_self");</script>';
        } 
    }
    else{
        if(isset($_SESSION['cart'])){
            echo '<script>window.open("index.php","_self");</script>';
            unset($_SESSION['cart']);
        }
    }
   
        
    
   
    // if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
    //     header('location: cart.php');
    // } else{
    //     header('location: index.php');
    // }
}


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
                    Cart
                </li>
            </ul><!-- breadcrumb Finish -->

        </div><!-- col-md-12 Finish -->

        <div id="cart" class="col-md-9">
            <!-- col-md-9 Begin -->

            <div class="box">
                <!-- box Begin -->

                <form action="cart.php" method="post">
                    <!-- form Begin -->
                    <h1>Shopping Cart</h1>
                    <p class="text-muted">You currently have
                        <?php echo count($_SESSION['cart'])?> item(s) in your cart
                    </p>
                    <div class="table-responsive">
                        <!-- table-responsive Begin -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <!-- tr Begin -->
                                    <th colspan="2">Product</th>
                                    <th class='text-center'>Quantity</th>
                                    <th class='text-center'>Unit Price</th>
                                    <th class='text-center' colspan="1">Delete</th>
                                    <th class='text-center' colspan="2">Sub-Total</th>
                                </tr><!-- tr Finish -->
                            </thead><!-- thead Finish -->
                            <tbody>
                                <?php 
                                // store product(array) that user get in a session named cart 
                             if(isset($_SESSION['cart']) && (count($_SESSION['cart'])) > 0){
                                $i = 0;
                                // declare i to get the index of product in cart for deleting
                                foreach($_SESSION['cart'] as $item){
                                    // get each product information in this session
                                    $img = $item[3];
                                    $price = $item[2];
                                    $name = $item[1];
                                    $count = $item[4];
                                    $total = $count * $price;
                                    echo "
                                    
                                        <tr>
                                            <td>
                                                <img class='img-responsive' src='../image/products/$img'
                                                alt='Product 3a'>
                                            </td>
                                            <td >
                                                <a href='#'>$name</a>
                                            </td>
                                            <td class='text-center'>
                                                $count
                                            </td>
                                            <td class='text-center'>
                                                $price
                                            </td>
                                            <td class='text-center'>
                                            <a class='btn btn-warning'  href='cart.php?act=delete_cart&i=$i' onclick='return confirm_delete();'>Delete Cart</a>
                                            </td>
                                            <td class='text-center'>
                                                $total
                                            </td>
                                        </tr>
                                       
                                    ";
                                $i++;
                                }
                            } ?>
                            </tbody>
                            <tfoot>
                                <!-- tfoot Begin -->
                                <tr>
                                    <!-- tr Begin -->

                                    <th colspan="5">Total</th>
                                    <?php 
                                    $total_price = totalPrice();
                                    echo"<th colspan='2' class='text-center'>$total_price</th>";
                                    ?>


                                </tr><!-- tr Finish -->

                            </tfoot><!-- tfoot Finish -->

                        </table><!-- table Finish -->

                    </div><!-- table-responsive Finish -->

                    <div class="box-footer">
                        <!-- box-footer Begin -->

                        <div class="pull-left">
                            <!-- pull-left Begin -->

                            <a href="index.php" class="btn btn-default">
                                <!-- btn btn-default Begin -->

                                <i class="fa fa-chevron-left"></i> Continue Shopping

                            </a><!-- btn btn-default Finish -->

                        </div><!-- pull-left Finish -->

                        <div class="pull-right">
                            <!-- pull-right Begin -->
                            <a class='btn btn-warning' href='cart.php?act=delete_cart'
                                onclick='return confirm_delete();'>Delete Cart</a>
                            <?php
                                 if(isset($_SESSION['email'])){
                                    $id =getUserID($_SESSION['email'], $conn);
                                    echo " <input type='submit' name='order' value='Proceed Checkout' class='btn btn-primary'>
                           

                            ";
                            }?>
                        </div><!-- pull-right Finish -->
                    </div><!-- box-footer Finish -->
                </form><!-- form Finish -->
                <?php 
             if(isset($_POST['order']))
             {
                $accID = getUserID($_SESSION['email'],$conn);
                $sql = "select * from orderInfo ";
                $stmt = $conn->prepare($sql);
                $stmt -> execute();
                $count = $stmt->rowCount();
                $orderCount = $count + 1;
                $orderID = 'OR'.$orderCount;
                $date = date("Y-m-d");
                $sql_orderInfo = "insert into orderInfo values (?,?,?)";
                $stmt_orderInfo = $conn -> prepare($sql_orderInfo);
                $stmt_orderInfo->bindParam(1,$orderID);
                $stmt_orderInfo->bindParam(2,$date);
                $stmt_orderInfo->bindParam(3,$accID);
                $stmt_orderInfo->execute();
                    if(isset($_SESSION['cart']) && (count($_SESSION['cart'])) > 0){
                   
                        foreach($_SESSION['cart'] as $item)
                        {
                            $productId = $item[0];
                            $price = $item[2];
                            $count = $item[4];
                            $total = $count * $price; 
                           

                            $sql_orderDetail = "insert into orderDetail values (?,?,?)";
                            $stmt_orderDetail = $conn -> prepare($sql_orderDetail);
                            $stmt_orderDetail->bindParam(1,$orderID);
                            $stmt_orderDetail->bindParam(2,$productId);
                            $stmt_orderDetail->bindParam(3,$count);
                            $stmt_orderDetail->execute();
                     
                        
                        } 
                    }
                    echo '<script>window.open("index.php","_self")</script>';
                    unset($_SESSION['cart']);
            } 
            ?>
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
                $query_product = $conn->prepare("select * from product order by rand() limit 0,3");
                $query_product->execute();
                ?>
                <?php while($row_p = $query_product->fetch()) {?>
                <div class="col-md-3 col-sm-6 center-responsive">
                    <!-- col-md-3 col-sm-6 center-responsive Begin -->
                    <div class="product same-height">
                        <!-- product same-height Begin -->
                        <a href="details.php?pro_id=<?=$row_p['productID']?>">
                            <img class="img-responsive" src="../image/products/<?php echo $row_p['productImage']?>"
                                alt="Product 6">
                        </a>

                        <div class="text">
                            <!-- text Begin -->
                            <h3><a href="details.php?pro_id=<?=$row_p['productID']?>">
                                    <?php echo $row_p['productName']; ?>
                                </a></h3>

                            <p class="price">
                                <?php echo $row_p['productPrice']?>
                            </p>

                        </div><!-- text Finish -->

                    </div><!-- product same-height Finish -->
                </div><!-- col-md-3 col-sm-6 center-responsive Finish -->
                <?php }?>


            </div><!-- #row same-heigh-row Finish -->

        </div><!-- col-md-9 Finish -->

        <div class="col-md-3">
            <!-- col-md-3 Begin -->

            <div id="order-summary" class="box">
                <!-- box Begin -->

                <div class="box-header">
                    <!-- box-header Begin -->

                    <h3>Order Summary</h3>

                </div><!-- box-header Finish -->

                <p class="text-muted">
                    <!-- text-muted Begin -->

                    Shipping and additional costs are calculated based on value you have entered

                </p><!-- text-muted Finish -->

                <div class="table-responsive">
                    <!-- table-responsive Begin -->

                    <table class="table">
                        <!-- table Begin -->

                        <tbody>
                            <!-- tbody Begin -->

                            <tr>
                                <!-- tr Begin -->

                                <td> Order Sub-Total </td>
                                <?php 
                                    $total_price = totalPrice();
                                    echo"<th class='text-center'>$total_price</th>";
                                    ?>


                            </tr><!-- tr Finish -->

                            <tr>
                                <!-- tr Begin -->

                                <td> Shipping and Handling </td>
                                <td> $0 </td>

                            </tr><!-- tr Finish -->

                            <tr class="total">
                                <!-- tr Begin -->
                                <td> Total </td>
                                <?php 
                                    $total_price = totalPrice();
                                    echo"<th  class='text-center'>$total_price</th>";
                                    ?>
                            </tr><!-- tr Finish -->

                        </tbody><!-- tbody Finish -->

                    </table><!-- table Finish -->

                </div><!-- table-responsive Finish -->

            </div><!-- box Finish -->

        </div><!-- col-md-3 Finish -->

    </div><!-- container Finish -->
</div><!-- #content Finish -->

<?php 
    
    include("includes/footer.php");
    
    ?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>


</body>

</html>