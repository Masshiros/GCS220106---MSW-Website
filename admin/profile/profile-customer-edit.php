<?php

    require_once("../../connection/connectdb.php");
   
?>
<?php
   
    try {
        $sql = 'select * 
        from customerAccount as a, customerProfile as p
        where a.accountID = p.accountID
        and p.profileID =?';
        $stmt_edit = $conn->prepare($sql);
        $stmt_edit->bindParam(1, $_GET['id']);
        $stmt_edit->execute();
        $row_edit = $stmt_edit->fetch();
       
        
    }catch(PDOException $ex) {
        echo 'Error: ' . $ex->getMessage();
    }

    //update product//
    if(isset($_POST['update'])) {
        try {
			$sql = "update customerProfile
                    set profileImage = ?, fullname = ?, address = ?, 
                        phone = ?    
                    where profileID = ?";

            $image = $_POST['profileImage'] == '' ? $_POST['old_image'] : $_POST['profileImage'];        
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(1, $image);
			$stmt->bindParam(2, $_POST['name']);
			$stmt->bindParam(3, $_POST['address']);	
			$stmt->bindParam(4, $_POST['phone']);
			
            $stmt->bindParam(5, $_POST['id']);   
			$stmt->execute();
            
            header("Location: ../customer/customer.php");
} catch(PDOException $ex) {
echo "Error: " . $ex->getMessage();
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
</head>

<body>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit your profile</h4>
                <p class="card-description"> Enter your information below </p>
                <form class="forms-sample" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group">
                        <label for="profileID">Profile ID:</label>
                        <input type="text" class="form-control" id="profileID" readonly
                            value="<?= $row_edit['profileID']?>" name="id">
                    </div>
                    <div class="form-group">
                        <label>Profile Image:</label>
                        <img src="../../image/profile/<?= $row_edit['profileImage'] ?>" height="80px" width="70px"
                            alt="no image">
                        <input type="hidden" name="old_image" value="<?= $row_edit['profileImage'] ?>">
                        <input type="file" name="profileImage" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary"
                                    type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Name: </label>
                        <input type="text" class="form-control" id="fullname" placeholder="Enter profile name"
                            value="<?= $row_edit['fullname']?>" name="name">
                    </div>
                    <div class="form-group">
                        <label for="address">Address: </label>
                        <input type="text" class="form-control" id="address" placeholder="Enter address"
                            value="<?= $row_edit['address']?>" name="address">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone: </label>
                        <input type="text" class="form-control" id="phone" placeholder="Enter phone"
                            value="<?= $row_edit['phone']?>" name="phone">
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2" name="update">Submit</button>
                    <a href="profile_customer.php?id=<?=$row_edit['accountID'] ?>" class="btn btn-light">Back</a>

                </form>
            </div>
        </div>
    </div>
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/file-upload.js"></script>
</body>

</html>