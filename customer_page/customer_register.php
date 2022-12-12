<?php
$active = 'Account';
include("includes/header.php");
?>
<?php 

if(isset($_POST['register']) && !validate_data_email($_POST['c_email']) && !validate_data_password($_POST['c_pass'])) {
    // use 2 function to check whether the data is validate 
    // push input data to variable
    $name = $_POST['c_name'];
    $email = $_POST['c_email'];
    $password = $_POST['c_pass'];
    $phone = $_POST['c_contact'];
    $address = $_POST['c_address'];
    $image = $_POST['c_image'];
      
    $sql_count_customer = 'select * from customerAccount';
    $stmt_count_customer = $conn->prepare($sql_count_customer);
    $stmt_count_customer->execute();
    // generate CUS ID 
    $count = $stmt_count_customer->rowCount();
    $customerCount = $count+1;
    $idAcc = trim('ACC'.(string)$customerCount);
    $idProfile = trim('CUS'.(string)$customerCount);
    // check whether the ID have existed
    while($getData = $stmt_count_customer->fetch()){
        if($idAcc == $getData['accountID']){
            $idAcc = trim('ACC'.(string)($customerCount+1));
            $idProfile = trim('CUS'.(string)($customerCount+1));
        }
    }
    // insert data into account and profile table 
    $insert_customerAccount = "insert into customerAccount values (?,?,?)";
    $stmt_insert_customerAccount =$conn ->prepare($insert_customerAccount);
    $stmt_insert_customerAccount->bindParam(1,$idAcc);
    $stmt_insert_customerAccount->bindParam(2,$email);
    $stmt_insert_customerAccount->bindParam(3,$password);
    $stmt_insert_customerAccount->execute();
    
    $insert_customerProfile = "insert into customerProfile values (?,?,?,?,?,?)";
    $stmt_insert_customerProfile =$conn ->prepare($insert_customerProfile);
    $stmt_insert_customerProfile->bindParam(1,$idProfile);
    $stmt_insert_customerProfile->bindParam(2,$image);
    $stmt_insert_customerProfile->bindParam(3,$name);
    $stmt_insert_customerProfile->bindParam(4,$address);
    $stmt_insert_customerProfile->bindParam(5,$phone);
    $stmt_insert_customerProfile->bindParam(6,$idAcc);
    $stmt_insert_customerProfile->execute();
    echo '<script>alert("Sign up successfully")</script>';

}



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
                    Register
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

            <div class="box">
                <!-- box Begin -->

                <div class="box-header">
                    <!-- box-header Begin -->

                    <center>
                        <!-- center Begin -->

                        <h2> Register a new account </h2>

                    </center><!-- center Finish -->

                    <form action="<?php ?>" method="POST" novalidate>
                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" class="form-control" name="c_name" required>
                        </div><!-- form-group Finish -->
                        <div class="form-group">
                            <!-- form-group Begin -->
                            <label>Your Email</label>
                            <input type="text" class="form-control" name="c_email" id="email" required>
                        </div><!-- form-group Finish -->
                        <div class="form-group">
                            <!-- form-group Begin -->
                            <label>Your Password</label>
                            <input type="password" class="form-control" name="c_pass" id="password" required>
                        </div><!-- form-group Finish -->
                        <div class="form-group">
                            <!-- form-group Begin -->
                            <label>Your Contact</label>
                            <input type="text" class="form-control" name="c_contact" required>
                        </div><!-- for-group Finish -->
                        <div class="form-group">
                            <!-- form-group Begin -->
                            <label>Your Address</label>
                            <input type="text" class="form-control" name="c_address">
                        </div><!-- form-group Finish -->
                        <div class="form-group">
                            <!-- form-group Begin -->
                            <label>Your Profile Picture</label>
                            <input type="file" class="form-control form-height-custom" name="c_image">
                        </div><!-- orm-group Finish -->
                        <div class="text-center">
                            <!-- text-center Begin -->
                            <button type="submit" name="register" class="btn btn-primary">
                                <i class="fa fa-user-md"></i> Register
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

<script type="text/javascript" src="js/jquery-331.min.js"></script>
<script type="text/javascript" src="js/bootstrap-337.min.js"></script>
<script src="js/validation.js"></script>


</body>

</html>