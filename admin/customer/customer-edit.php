<?php
    session_start();
    if( !isset($_SESSION['username'])){
    header("location: ../login/login.php");
    }
    require_once("../../connection/connectdb.php");
    require("../function.php");
?>

<?php

  

    try {
        $sql = "select * from customerAccount where accountID = ?";
        $stmt_edit = $conn->prepare($sql);
        $stmt_edit->bindParam(1, $_GET['id']);
        $stmt_edit->execute();
        $row_edit = $stmt_edit->fetch();
    }catch(PDOException $ex) {
        echo 'Error: ' . $ex->getMessage();
    }

    //update //
    if(isset($_POST['update'])) {
        try {
			$sql = "update customerAccount
                    set email =? , userPassword =?  
                    where accountID = ?";

              
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(1, $_POST['email']);
			$stmt->bindParam(2, $_POST['userPassword']);
			$stmt->bindParam(3, $_POST['id']);   
			$stmt->execute();
			header('Location: customer.php');	
		} catch(PDOException $ex) {
			echo "Error: " . $ex->getMessage();
		}
    }
?>

<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <title>Update product</title>
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
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" method="POST"
                                        action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                        <div class="form-group">
                                            <label for="accountID">Account ID:</label>
                                            <input type="text" class="form-control" id="accountID" readonly
                                                value="<?= $row_edit['accountID']?>" name="id">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email </label>
                                            <input type="text" class="form-control" id="email" placeholder="Enter email"
                                                value="<?= $row_edit['email']?>" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="userPassword">Password: </label>
                                            <input type="password" class="form-control" id="userPassword"
                                                placeholder="Enter password" value="<?= $row_edit['userPassword']?>"
                                                name="userPassword">
                                        </div>


                                        <button type="submit" class="btn btn-gradient-primary me-2"
                                            name="update">Submit</button>
                                        <a href="customer.php" class="btn btn-light">Back</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">MSW Company
                            2021</span>
                        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> By <a href="#"
                                target="_blank">Masshiro</a> from Masshirona.com</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>


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
    <script src="../assets/js/file-upload.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
</body>

</html>