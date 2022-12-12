<?php

    function getUserData($id,$conn){
    $sql = "select * from
    adminAccount as a , staff as s
    where a.staffID = s.staffID 
    and a.adminID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

    function getUserID($username,$conn){
    $sql = "select adminID from adminAccount where username = ?";
    $stmt = $conn-> prepare($sql);
    $stmt->bindParam(1,$username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['adminID']; 
    

}
    function countRecord($conn,$table){
        $sql = "select * from". " " . $table;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }
?>