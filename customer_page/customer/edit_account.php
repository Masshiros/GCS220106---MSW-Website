<?php
    try {
        $sql = "select * from customerProfile where profileID = ?";
        $stmt_edit = $conn->prepare($sql);
        $stmt_edit->bindParam(1, $_GET['id']);
        $stmt_edit->execute();
        $row_edit = $stmt_edit->fetch();
    }catch(PDOException $ex) {
        echo 'Error: ' . $ex->getMessage();
    }

    //update profile//
    if(isset($_POST['update'])) {
        try {
			$sql = "update customerProfile
                    set fullname = ?, address = ?, profileImage = ?, 
                        phone = ?   
                    where profileID = ?";

            $image = $_POST['image'] == '' ? $_POST['old_image'] : $_POST['image'];        
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(1, $_POST['name']);
			$stmt->bindParam(2, $_POST['address']);
			$stmt->bindParam(3, $image);	
			$stmt->bindParam(4, $_POST['phone']);
		    $stmt->bindParam(5, $_POST['id']);   
			$stmt->execute();
				
		} catch(PDOException $ex) {
			echo "Error: " . $ex->getMessage();
		}
    }
?>
<h1 align="center">Edit your account</h1>
<form action="" method="POST">
    <!--form begin -->
    <div class="form-group">

        <label for="">Profile ID:</label>
        <input type="text" name="id" id="" class="form-control" readonly value="<?= $row_edit['profileID']?>">

    </div>
    <div class="form-group">

        <label for="">Customer Name:</label>
        <input type="text" name="name" id="" class="form-control" required value="<?= $row_edit['fullname']?>">

    </div>
    <div class=" form-group">

        <label for="">Customer Address:</label>
        <input type="text" name="address" id="" class="form-control" required value="<?= $row_edit['address']?>">

    </div>
    <div class="form-group">

        <label for="">Customer Phone:</label>
        <input type="text" name="phone" id="" class="form-control" required value="<?= $row_edit['phone']?>">

    </div>
    <div class="form-group">

        <label for="">Customer Image:</label>
        <input type="file" name="image" id="" class="form-control">
        <img src="../../image/profile/<?= $row_edit['profileImage'] ?>" alt="No Image" class="img-responsive"
            style="max-width:500px; max-height:500px">
        <input type="hidden" name="old_image" value="<?= $row_edit['profileImage'] ?>">
    </div>
    <div class="text-center">
        <button name="update" class="btn btn-primary">
            <i class="fa fa-user-md"></i>Update Now
        </button>
    </div>
</form>