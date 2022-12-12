<?php
    require_once("../../connection/connectdb.php");
?>

<?php
    try {
        $sql = "delete from category where categoryID = ?";
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(1, $_GET['id']);
        $stmt->execute();
		header('Location: category.php');
    }catch(PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
?>