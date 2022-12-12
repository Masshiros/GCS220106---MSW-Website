<?php
    session_start();
    if( !isset($_SESSION['username'])){
    header("location: ../login/login.php");
    }
    require_once("../../connection/connectdb.php");
    require("../function.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
        integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap-grid.min.css"
        integrity="sha512-JQksK36WdRekVrvdxNyV3B0Q1huqbTkIQNbz1dlcFVgNynEMRl0F8OSqOGdVppLUDIvsOejhr/W5L3G/b3J+8w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div class="card card-style1 border-0">
                        <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                            <div class="row align-items-center">
                                <?php if(isset($_SESSION['username'])) {
                                $userData = getUserData(trim(getUserID($_SESSION['username'],$conn)),$conn);
                                ?>
                                <div class="col-lg-6 mb-4 mb-lg-0 d-flex justify-content-center align-items-center">

                                    <img src="../../image/staff/<?=$userData['staffImage'] ?>" alt="...">
                                </div>
                                <div class="col-lg-6 px-xl-10">
                                    <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded"
                                        style="width:100%">
                                        <h3 class="h2 text-white mb-0"><?=$userData['staffName'] ?></h3>
                                        <span class="text-white"><?=$userData['staffRole'] ?></span>
                                    </div>
                                    <ul class="list-unstyled mb-1-9">
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">StaffID:</span>
                                            <?=$userData['staffID'] ?></li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Name:</span>
                                            <?=$userData['staffName'] ?></li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Email:</span>
                                            <?=$userData['staffEmail'] ?></li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Role:</span>
                                            <?=$userData['staffRole'] ?></li>
                                        <li class="display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Phone:</span>
                                            <?=$userData['staffPhone'] ?></li>
                                    </ul>
                                    <ul class="social-icon-style1 list-unstyled mb-0 ps-0">
                                        <li><a href="#!"><i class="fa-brands fa-twitter"></i></a></li>
                                        <li><a href="#!"><i class="fa-brands fa-facebook"></i></a></li>
                                        <li><a href="#!"><i class="fa-brands fa-pinterest"></i></a></li>
                                        <li><a href="#!"><i class="fa-brands fa-instagram"></i></i></a></li>
                                    </ul>
                                    <a href="../index.php"><button type="button"
                                            class="btn btn-outline-primary">Back</button></a>

                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
        integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>