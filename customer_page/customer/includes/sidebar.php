<div class="panel panel-default sidebar-menu">
    <!--  panel panel-default sidebar-menu Begin  -->

    <div class="panel-heading">
        <!--  panel-heading  Begin  -->

        <center>
            <!--  center  Begin  -->
            <?php
            if(isset($_SESSION['email'])){
                $img = getUserData(getUserID($_SESSION['email'], $conn),$conn)['profileImage'];
                echo "<img src='../../image/profile/$img' alt='User Image'>";
            }
                ?>


        </center><!--  center  Finish  -->

        <br />

        <h3 align="center" class="panel-title">
            <!--  panel-title  Begin  -->
            <?php
            if(isset($_SESSION['email'])){
                $name = getUserData(getUserID($_SESSION['email'], $conn),$conn)['fullname'];
                echo 'Name:'.' '.$name;
            }
            ?>

        </h3><!--  panel-title  Finish -->

    </div><!--  panel-heading Finish  -->

    <div class="panel-body">
        <!--  panel-body Begin  -->

        <ul class="nav-pills nav-stacked nav">
            <!--  nav-pills nav-stacked nav Begin  -->

            <li class="<?php if(isset($_GET['edit_account'])){ echo "active"; } ?>">
                <?php
                 if(isset($_SESSION['email'])){
                    $id = getUserData(getUserID($_SESSION['email'], $conn),$conn)['profileID'];
                    echo "<a href='my_account.php?edit_account&id=$id'>

                            <i class='fa fa-pencil'></i> Edit Account

                        </a>";
                }
                ?>


            </li>

            <li class="<?php if(isset($_GET['change_pass'])){ echo "active"; } ?>">
                <?php
                 if(isset($_SESSION['email'])){
                    $id =getUserID($_SESSION['email'], $conn);
                    echo "<a href='my_account.php?change_pass&id=$id'>
                             <i class='fa fa-user'></i> Change Password
                         </a>
                    ";
                 }?>


            </li>

            <li class="<?php if(isset($_GET['delete_account'])){ echo "active"; } ?>">

                <?php
                 if(isset($_SESSION['email'])){
                    $id =getUserID($_SESSION['email'], $conn);
                    echo "<a href='my_account.php?delete_account&id=$id'>
                             <i class='fa fa-user'></i> Delete Account
                         </a>
                    ";
                 }?>

            </li>

            <li>
                <?php
                 if(isset($_SESSION['email'])){
                    
                    echo "<a href='../logout.php'>
                             <i class='fa fa-user'></i> Log Out
                         </a>
                    ";
                 }?>

            </li>

        </ul><!--  nav-pills nav-stacked nav Begin  -->

    </div><!--  panel-body Finish  -->

</div><!--  panel panel-default sidebar-menu Finish  -->