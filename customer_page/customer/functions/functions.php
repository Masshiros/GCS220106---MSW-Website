<?php
// userData 

function getUserData($id,$conn){
    $sql = "select * from
    customerAccount as a , customerProfile as p
    where a.accountID = p.accountID
    and a.accountID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

    function getUserID($email,$conn){
    $sql = "select accountID from customerAccount where email = ?";
    $stmt = $conn-> prepare($sql);
    $stmt->bindParam(1,$email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['accountID']; 
    

}

//total_price
function totalPrice(){
   
    $total_price = 0;
    if(isset($_SESSION['cart']) && (count($_SESSION['cart'])) > 0){
        foreach($_SESSION['cart'] as $item){
        $price = $item[2];
        $count = $item[4];
        $total = $count * $price;
        $total_price = $total_price + $total;
        }
     }
     return $total_price;
}
function getCatPro($conn){
    if(isset($_GET['p_cat'])){
        $productCatID = $_GET['p_cat'];
        $sql = "select * from category where categoryID = $productCatID";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();
        $categoryName = $row['categoryName'];
        $categoryDesc = $row['descriptions'];
        $sql_products = "select * from product where categoryID = $productCatID";
        $stmt_products = $conn->prepare($sql_products);
        $stmt_products->execute();
        $count = $stmt_products->rowCount();
        if($count==0){
            echo "
            <div class='box'>
                <h1>No Product Found in this Product Category</h1>
            </div>
            ";
        }
        else{
            echo "
            <div class='box'>
                <h1> $categoryName </h1>
                <p> $categoryDesc </p>
            </div>
            ";
        }
        while($row_products = $stmt_products->fetch() ){
                    $id = $row_products['productID'];
                    $name = $row_products['productName'];
                    $image = $row_products['productImage'];
                    $price = $row_products['productPrice'];
                        echo
                    "<div class='col-md-4 col-sm-6 center-responsive'>
                    <div class='product'>

                        <a href='details.php?pro_id=$id'>
                            <img class='img-responsive' src='../image/products/$image ' alt='Product 1'>
                        </a>
                        <div class='text'>
                            <!-- text Begin -->
                            <h3>
                                <a href='details.php'>$name </a>
                            </h3>
                            <p class='price'> $price</p>
                            <p class='button'>

                                <a href='details.php?pro_id=$id' class='btn btn-default'>View Details</a>

                                <a href='details.php?pro_id=$id' class='btn btn-primary'>

                                    <i class='fa fa-shopping-cart'>
                                        Add To Cart
                                    </i>
                                </a>
                            </p>
                        </div>
                    </div>
                    </div>
                ";
                }
        }
    }



?>