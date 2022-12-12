<?php
session_start();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}
require_once("db.php");
require_once("./functions/functions.php");
?>
<?php
if(isset($_POST['addtocart']) && ($_POST['addtocart'])){
    $productName = $_POST['productName'];
    $productImage = $_POST['productImage'];
    $productID = $_POST['productID'];
    $productPrice = $_POST['productPrice'];
    // use for detail.php case - when customer input the count they want
   
    if(isset($_POST['count']) && ($_POST['count'] > 0 )){
        $count = $_POST['count'];
    }
    else{
        $count = 1;
        }
    $flag = 0;
    // create a variable named flat to check whether there is a same product in cart
    
    // check in the cart , whether there is a same product 
    $i = 0;
    foreach($_SESSION['cart'] as $item ){
        if($item[1] == $productName){
            $newCount = $count + $item[4];
            $_SESSION['cart'][$i][4] = $newCount;
            $flag = 1;
            break;
        }
        $i++;
    }
    if($flag==0){
        $items = array($productID,$productName,$productPrice,$productImage,$count);
        $_SESSION['cart'][]= $items;
    }
}
?>


<?php
//only 8 product display in home page
    $sql = 'select * from product limit 0,8';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
?>
<?php
// get pro_id to detail page , and display by using $_GET
    if(isset($_GET['pro_id'])){
        $sql_get_product = "select * from product where productId = ?";
        $stmt_product = $conn->prepare($sql_get_product);
        $stmt_product->bindParam(1,$_GET['pro_id']);
        $stmt_product->execute();
        $row_product =$stmt_product->fetch();
        $sql_get_cat = 'select * from category where categoryID = ?';
        $stmt_get_cat=$conn->prepare($sql_get_cat);
        $stmt_get_cat->bindParam(1,$row_product['categoryID']);
        $stmt_get_cat->execute();
        $row_cat = $stmt_get_cat->fetch();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masshiro Store</title>
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script type="text/javascript">
    function confirm_delete() {
        return confirm('Are you sure?');
    }
    </script>

</head>

<body>

    <div id="top">
        <!-- Top Begin -->

        <div class="container">
            <!-- container Begin -->

            <div class="col-md-6 offer">
                <!-- col-md-6 offer Begin -->

                <a href="#" class="btn btn-success btn-sm">Welcome</a>
                <a href="checkout.php">
                    <?php echo count($_SESSION['cart'])?> items in your cart | Total Price:
                    <?php echo totalPrice();?>
                </a>

            </div><!-- col-md-6 offer Finish -->

            <div class="col-md-6">
                <!-- col-md-6 Begin -->

                <ul class="menu">
                    <!-- cmenu Begin -->

                    <li>
                        <a>
                            <?php
                            if(isset($_SESSION['email'])){
                                $name = getUserData(getUserID($_SESSION['email'], $conn),$conn)['fullname'];
                                echo 'Welcome,'.' '.$name;
                            }
                            else{
                                echo '<a href="customer_register.php">Register</a>';
                            }
                            ?>
                        </a>
                    </li>
                    <li>
                        <a href="customer/my_account.php">
                            My Account

                        </a>
                    </li>
                    <li>
                        <a href="cart.php">Go To Cart</a>
                    </li>
                    <li>

                        <?php
                            if(!isset($_SESSION['email'])){
                                echo "<a href='login.php'>Login</a>";
                            }
                                else{
                                    echo "<a href='logout.php'>Log Out</a>";
                                }
                            ?>


                    </li>

                </ul><!-- menu Finish -->

            </div><!-- col-md-6 Finish -->

        </div><!-- container Finish -->

    </div><!-- Top Finish -->

    <div id="navbar" class="navbar navbar-default">
        <!-- navbar navbar-default Begin -->

        <div class="container">
            <!-- container Begin -->

            <div class="navbar-header">
                <!-- navbar-header Begin -->

                <a href="index.php" class="navbar-brand home">
                    <!-- navbar-brand home Begin -->

                    <img src="" alt="MSW Logo" class="hidden-xs">
                    <img src="" alt="MSW Logo Mobile" class="visible-xs">

                </a><!-- navbar-brand home Finish -->

                <button class="navbar-toggle" data-toggle="collapse" data-target="#navigation">

                    <span class="sr-only">Toggle Navigation</span>

                    <i class="fa fa-align-justify"></i>

                </button>

                <button class="navbar-toggle" data-toggle="collapse" data-target="#search">

                    <span class="sr-only">Toggle Search</span>

                    <i class="fa fa-search"></i>

                </button>

            </div><!-- navbar-header Finish -->

            <div class="navbar-collapse collapse" id="navigation">
                <!-- navbar-collapse collapse Begin -->

                <div class="padding-nav">
                    <!-- padding-nav Begin -->

                    <ul class="nav navbar-nav left">
                        <!-- nav navbar-nav left Begin -->

                        <li class="<?php if($active=='Home') echo"active"; ?>">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="<?php if($active=='Shop') echo"active"; ?>">
                            <a href="shop.php">Shop</a>
                        </li>
                        <li class="<?php if($active=='Account') echo"active"; ?>">
                            <a href="customer/my_account.php">My Account</a>
                        </li>
                        <li class="<?php if($active=='Cart') echo"active"; ?>">
                            <a href="cart.php">Shopping Cart</a>
                        </li>
                        <li class="<?php if($active=='Contact') echo"active"; ?>">
                            <a href="contact.php">Contact Us</a>
                        </li>
                        <li>
                            <a href="../admin/login/login.php">ADMIN</a>
                        </li>

                    </ul><!-- nav navbar-nav left Finish -->

                </div><!-- padding-nav Finish -->

                <a href="cart.php" class="btn navbar-btn btn-primary right">
                    <!-- btn navbar-btn btn-primary Begin -->

                    <i class="fa fa-shopping-cart"></i>

                    <span><?php echo count($_SESSION['cart'])?> Items In Your Cart</span>

                </a><!-- btn navbar-btn btn-primary Finish -->

                <div class="navbar-collapse collapse right">
                    <!-- navbar-collapse collapse right Begin -->

                    <button class="btn btn-primary navbar-btn" type="button" data-toggle="collapse"
                        data-target="#search">
                        <!-- btn btn-primary navbar-btn Begin -->

                        <span class="sr-only">Toggle Search</span>

                        <i class="fa fa-search"></i>

                    </button><!-- btn btn-primary navbar-btn Finish -->

                </div><!-- navbar-collapse collapse right Finish -->

                <div class="collapse clearfix" id="search">
                    <!-- collapse clearfix Begin -->

                    <form method="get" action="results.php" class="navbar-form">
                        <!-- navbar-form Begin -->

                        <div class="input-group">
                            <!-- input-group Begin -->

                            <input type="text" class="form-control" placeholder="Search" name="user_query" required>

                            <span class="input-group-btn">
                                <!-- input-group-btn Begin -->

                                <button type="submit" name="search" value="Search" class="btn btn-primary">
                                    <!-- btn btn-primary Begin -->

                                    <i class="fa fa-search"></i>

                                </button><!-- btn btn-primary Finish -->

                            </span><!-- input-group-btn Finish -->

                        </div><!-- input-group Finish -->

                    </form><!-- navbar-form Finish -->

                </div><!-- collapse clearfix Finish -->

            </div><!-- navbar-collapse collapse Finish -->

        </div><!-- container Finish -->

    </div><!-- navbar navbar-default Finish -->