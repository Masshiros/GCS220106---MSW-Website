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

    //update password//
    if(isset($_POST['change'])) {
        if(isset($_POST['old_pass']) && $_POST['old_pass'] == $row_edit['userPassword']){
            if(isset($_POST['new_pass'] )&& $_POST['new_pass'] == $_POST['new_pass_again']) {
                try {
                    $sql = "update customerAccount
                            set userPassword = ?  
                            where accountID = ?";
        
                       
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $_POST['new_pass']);
                    $stmt->bindParam(2, $_GET['id']);   
                    $stmt->execute();
                   
                } catch(PDOException $ex) {
                    echo "Error: " . $ex->getMessage();
                }
                echo "<script>alert('Change password successfully')</script>";
            }
            else{
                echo "<script>alert('Please confirm your new password accurately')</script>";
            
            }
        }
        else{
            echo "<script>alert('Wrong password input. Check it again')</script>";
        }
        
    }
?>
<h1 align="center">Change password</h1>
<form action="" method="POST">
    <!--form begin -->
    <div class="form-group">

        <label for="">Your old password:</label>
        <input type="password" name="old_pass" id="" class="form-control" required>

    </div>
    <div class=" form-group">

        <label for="">Your new password:</label>
        <input type="password" name="new_pass" id="" class="form-control" required>

    </div>
    <div class="form-group">

        <label for="">Confirmation</label>
        <input type="password" name="new_pass_again" id="" class="form-control" required>

    </div>
    <div class="text-center">
        <button type="submit" name="change" class="btn btn-primary">
            <i class="fa fa-user-md"></i>Update Now
        </button>
    </div>
</form>