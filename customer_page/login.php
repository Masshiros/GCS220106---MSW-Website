<?php
$active = 'Account';
include("includes/header.php");
?>
<div id="content">
    <!-- #content Begin -->
    <div class="container">
        <!-- container Begin -->
        <div class="col-md-12">

            <ul class="breadcrumb">
                <!-- breadcrumb Begin -->
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    Login
                </li>
            </ul><!-- breadcrumb Finish -->

        </div><!-- col-md-12 Finish -->

        <div class="col-md-3">
            <!-- col-md-3 Begin -->



        </div><!-- col-md-3 Finish -->

        <div class="col-md-12">
            <!-- col-md-9 Begin -->

            <div class="box">
                <!-- box Begin -->

                <div class="box-header">
                    <!-- box-header Begin -->

                    <center>
                        <!-- center Begin -->

                        <h2> Login </h2>

                    </center><!-- center Finish -->
                    <?php
                    if(isset($_POST['login']))
                    {
                        // check whether the email and userPassword is correct 
                        $sql = "select * from customerAccount
                         where email = ? and userPassword = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, trim($_POST['c_email']));
                        $stmt->bindParam(2, trim($_POST['c_pass']));
                        $stmt->execute();
                        $row = $stmt->fetch();
                        // if correct
                        if($row){
                            // create session email to authenticate
                            $_SESSION['email'] =  $_POST['c_email'];
                            echo '<script>window.open("index.php", "_self").focus()</script>';
                                                     }
                        else{
                            echo'<script>alert("Login failed")</script>';
                           }
                       
                       
                    }
                    ?>

                    <form action="<?php ?>" method="POST">

                        <div class="form-group">
                            <!-- form-group Begin -->
                            <label>Your Email</label>

                            <input type="text" class="form-control" name="c_email">

                        </div><!-- form-group Finish -->

                        <div class="form-group">
                            <!-- form-group Begin -->

                            <label>Your Password</label>

                            <input type="password" class="form-control" name="c_pass">

                        </div><!-- form-group Finish -->
                        <div class="text-center">
                            <!-- text-center Begin -->

                            <button type="submit" name="login" class="btn btn-primary">

                                <i class="fa fa-user-md"></i> Login

                            </button>

                        </div><!-- text-center Finish -->

                    </form><!-- form Finish -->

                </div><!-- box-header Finish -->

            </div><!-- box Finish -->

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