<?php include "include/config.php";
session_start();
?>
<?php include "head.php"; ?>
<title>YOur Cart</title>
<?php include "header.php";

if (isset($_POST["remove_item"])) {
    extract($_POST);
    try {
        $sql = $conn->prepare("UPDATE `cart` SET `count`= count - 1 WHERE Item_id = :item_id AND email = :email");
        $sql->execute(array(
            ":item_id"=>$item_id,
            ":email"=>$_SESSION["email"],

        ));
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>';
        echo '<strong> Item Removed Successfully!';
        
        echo ' </strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<?php
if (isset($_POST["add_item"])) {
    extract($_POST);
    
    try {
        $sql = $conn->prepare("UPDATE `cart` SET `count`= count + 1 WHERE Item_id = :item_id AND email = :email");
        $sql->execute(array(
            ":item_id"=>$item_id,
            ":email"=>$_SESSION["email"],

        ));
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>';
        echo 'Item Updated Successfully!';
        echo ' </strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<?php
if (isset($_POST["delete_item"])) {
    extract($_POST);
    
    try {
        $sql = $conn->prepare("DELETE FROM `cart` WHERE `Item_id` = :item_id AND email = :email");
        $sql->execute(array(
            ":item_id"=>$item_id,
            ":email"=>$_SESSION["email"],

        ));
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>';
        echo 'Item Deleted  Successfully!';
        echo ' </strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
     
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>


<div class="cart">

    <h1>Your Cart : </h1>
    
    <div class="cart-lists">
        <?php
        $user_email = $_SESSION["email"];

        $sql = $conn->prepare("SELECT * FROM `cart` WHERE `email` LIKE :email AND `count` > 0");

        $sql->execute(array(
            ":email" => $user_email,
        ));
        $total_price = 0;
        foreach ($sql->fetchAll() as $row) {
            $sql1 = $conn->prepare("SELECT * FROM `mstitem` WHERE `id` = :item_id");
            $sql1->execute(array(
                ":item_id" => $row["Item_id"],
            ));
            $row1 = $sql1->fetch();
            $total_price += $row["count"]*$row1["rate"];
        
        echo '<div class="cart-list">
            <div class="cart-list-name"><h3>' . $row1["itemname"] . '</h3> 
            </div>
            <div class="cart-list-quantity">
            <form action="" method="POST"> <input type="hidden" value="'.$row["Item_id"].'" name= "item_id" ><button  name= "remove_item" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
              </svg></button></form>' . $row["count"].'<form  action="" method="POST"> <input type="hidden" value="'.$row["Item_id"].'" name= "item_id" ><button  name= "add_item" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                  </svg></button></form>
            </div>

            <div class="cart-list-price"><h4>Rs ' . $row1["rate"] . '</h4> </div>

            <form class="cart-list-delete action="" method="POST"> <input type="hidden" value="'.$row["Item_id"].'" name= "item_id" /><button  name= "delete_item" class="btn del_item" style="color:red;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
              </svg></button></form>
        </div>';
        
    }
        ?>
       
        
    </div>

    <?php
    
    try {
        $sql = $conn->prepare("SELECT * FROM `cart` WHERE `email` LIKE :email");

        $sql->execute(array(
            ":email" => $user_email,
        ));
         $sql1= $conn->prepare("SELECT * FROM `cart` WHERE `email` LIKE :email AND `count` = 0");
        $sql1->execute(array(
            ":email" => $user_email,
        ));
        $row= $sql->rowCount();
        $row1= $sql1->rowCount();
        if ($sql->rowCount() == 0 ) {

            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>';
            echo 'Please add some item in cart to view';
            echo ' </strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';


        }
       

        elseif($row == $row1){
            
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>';
            echo 'Please add some item in cart to view';
            echo ' </strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

        }
        else{
            echo '     <div class="subtotal">
            <h3>Subtotal : </h3>
            <h4>Rs '.$total_price.'</h4>
        </div>
<div class="checkout-btn"> <a class="btn1 "> Proceed</a></div>';
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>

   



</div>







<?php include "footer.php"; ?>


