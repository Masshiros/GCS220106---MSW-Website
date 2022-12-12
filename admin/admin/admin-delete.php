<?php
    require_once("../../connection/connectdb.php");
?>

<?php
    try {
        $sql = "delete from adminAccount where adminID = ?";
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(1, $_GET['id']);
        $stmt->execute();
		header('Location: admin.php');
    }catch(PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
?>