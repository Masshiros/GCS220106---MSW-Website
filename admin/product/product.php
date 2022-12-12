<?php
    session_start();
    if( !isset($_SESSION['username'])){
    header("location: ../login/login.php");
    }
    require_once("../../connection/connectdb.php");
    require("../function.php");
?>
<?php
// the maximum product on one page
    $LIMIT = 5;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
               
    }else{
          $page = '';
    };
    if($page == '' || $page == 1){
        $begin_product = 0;
    }
    else{
        // formula to get the begin index product with page and limit
        $begin_product = ($page-1)*$LIMIT;
    }
    try{
        $sql = 'select * from product';
    //    pagination
        $sql_page = $conn-> prepare($sql);
        $sql_page ->execute();
        $row_count = $sql_page -> rowCount();
        $pages = ceil($row_count / $LIMIT);
           }
    catch(PDOException $ex){
        echo "Error:" .$ex->getMessage();
    }
    ?>
<?php 
   try{
    
    $sql = " select p.*, c.categoryName
    from product as p , category as c
    where p.categoryID = c.categoryID
    limit $begin_product , $LIMIT ";
    $stmt = $conn-> prepare($sql);
    $stmt->execute();
}
catch(PDOException $ex){
    echo "Error:" .$ex->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css"
        integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="../index.php"><img src="../assets/images/logo.svg"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="../index.php"><img src="../assets/images/logo-mini.svg"
                        alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?php if(isset($_SESSION['username'])) {
                                $userData = getUserData(trim(getUserID($_SESSION['username'],$conn)),$conn);
                                ?>
                            <div class="nav-profile-img">
                                <img src="../../image/staff/<?=$userData['staffImage'] ?>" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">
                                    <?php echo $userData['staffName']; ?>
                                </p>
                            </div>
                            <?php }?>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="../profile/profile.php">
                                <i class="mdi mdi-cached me-2 text-success"></i> My Profile </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../login/logout.php">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-logout d-none d-lg-block">
                        <a class="nav-link" href="../login/logout.php">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <?php if(isset($_SESSION['username'])) {
                                $userData = getUserData(trim(getUserID($_SESSION['username'],$conn)),$conn);
                                ?>
                            <div class="nav-profile-image">
                                <img src="../../image/staff/<?=$userData['staffImage'] ?>" alt="profile">
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">
                                    <?php echo $userData['staffName']?>
                                </span>
                                <span class="text-secondary text-small"><?php echo $userData['staffRole']?></span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                            <?php }?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../category/category.php">
                            <span class="menu-title">Category</span>
                            <i class="mdi mdi-table-large menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../product/product.php">
                            <span class="menu-title">Product</span>
                            <i class="mdi mdi-table-large menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../customer/customer.php">
                            <span class="menu-title">Customer</span>
                            <i class="mdi mdi-table-large menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../staff/staff.php">
                            <span class="menu-title">Staff</span>
                            <i class="mdi mdi-table-large menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/admin.php">
                            <span class="menu-title">Admin</span>
                            <i class="mdi mdi-table-large menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../order/order.php">
                            <span class="menu-title">Order</span>
                            <i class="mdi mdi-table-large menu-icon"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Products </h3>

                    </div>
                    <div class="row">

                        <!-- Table Product -->
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="btn btn-outline-info col-3"><a href="product-add.php">Add
                                            Product</a></p>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($row = $stmt->fetch()) { ?>
                                            <tr>
                                                <td><?= $row['productID'] ?></td>
                                                <td><?= $row['productName'] ?></td>
                                                <td><?= $row['productPrice'] ?></td>
                                                <td>
                                                    <a href="#" title="<?= $row['productDetail'] ?>">
                                                        <img src="../../image/products/<?= $row['productImage'] ?>"
                                                            alt="No image">
                                                    </a>
                                                </td>
                                                <td>
                                                    <?= $row['categoryName']?>
                                                </td>
                                                <td>
                                                    <a href="product-edit.php?id=<?= $row['productID'] ?>" class="tags"
                                                        gloss="Edit this product">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="product-delete.php?id=<?= $row['productID']?>" class="tags"
                                                        gloss="Delete this product">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <!-- Pagination -->
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <!-- Previous button  -->
                                            <li class="page-item"><a class="page-link"
                                                    href="product.php?page=<?php $page>1 ? print (int)$page - 1 : print $pages ?>">Previous</a>
                                            </li>
                                            <?php
                                            // automatically generate new page pagination when pages increase 
                                            for($i = 1; $i<= $pages; $i++) { ?>
                                            <li class="page-item"><a
                                                    class="page-link <?php $i == (int)$page ? print("bg-primary text-white") :''?>"
                                                    href="product.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                                            </li>
                                            <?php }?>
                                            <!-- Next button to change page: Page + 1  -->
                                            <li class="page-item"><a class="page-link"
                                                    href="product.php?page=<?php $page<$pages ? print (int)$page + 1 : print "1" ?>">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <!-- end pagination -->
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class=" footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">MSW
                            Company
                            2021</span>
                        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> By
                            <a href="#" target="_blank">Masshiro</a> from
                            Masshirona.com</span>
                    </div>
                </footer>
                <!-- partial -->

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
</body>

</html>