<?php
if(isset($_POST['Yes'])){
    $sql = 'delete from customerAccount where accountID = ? ';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$_GET['id']);
    $stmt->execute();
    unset($_SESSION['email']);
}
?>
<center>
    <h1>Do you really want to delete your account </h1>
    <form action="" method="post">
        <!-- form begin-->
        <input type="submit" name="Yes" value="Yes" class="btn btn-danger" onclick="return confirm_delete()">
        <input type=" submit" name="No" value="No" class="btn btn-primary" style="width:50px;">
    </form>
</center>