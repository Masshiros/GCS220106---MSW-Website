<?php
require_once("db.php");
?>
<?php
    $sql = 'select * from category';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
?>
<div class="panel panel-default sidebar-menu">
    <!-- panel panel-default sidebar-menu Begin -->
    <div class="panel-heading">
        <!-- panel-heading Begin -->
        <h3 class="panel-title">Categories</h3>
    </div><!-- panel-heading Finish -->

    <div class="panel-body">
        <!-- panel-body Begin -->


        <ul class="nav nav-pills nav-stacked category-menu">
            <!-- nav nav-pills nav-stacked category-menu Begin -->
            <li><a href="shop.php">All</a></li>
            <?php while($row = $stmt->fetch()){ ?>
            <li><a href=" shop.php?p_cat=<?=$row['categoryID']?>">
                    <?=$row['categoryName'] ?>
                </a></li>
            <?php }?>


        </ul><!-- nav nav-pills nav-stacked category-menu Finish -->

    </div><!-- panel-body Finish -->

</div><!-- panel panel-default sidebar-menu Finish -->