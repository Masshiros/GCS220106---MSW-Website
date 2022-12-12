<?php
    require_once("../../connection/connectdb.php");
?>

<?php
    try {
        $sql = "delete from staff where staffID = ?";
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(1, $_GET['id']);
        $stmt->execute();
		header('Location: staff.php');
    }catch(PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
?>