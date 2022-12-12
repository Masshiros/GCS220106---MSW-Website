<?php
    require_once("../../connection/connectdb.php");
?>

<?php
    try {
        $sql = "delete from customerAccount where accountID = ?";
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(1, $_GET['id']);
        $stmt->execute();
		header('Location: customer.php');
    }catch(PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
?>