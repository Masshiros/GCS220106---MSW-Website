<?php
    require_once("../../connection/connectdb.php");
?>

<?php
    try {
        $sql = "delete from product where productID = ?";
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(1, $_GET['id']);
        $stmt->execute();
		header('Location: product.php');
    }catch(PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
?>