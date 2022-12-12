<?php 
    session_start();
    if( isset($_SESSION['email'])){
       unset($_SESSION['email']);
       
    }
    if( isset($_SESSION['cart'])){
       unset($_SESSION['cart']);
       
    }
    header('location: login.php')
?>