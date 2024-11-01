<?php include "include/config.php"; ?>
<?php 
session_start();
?>
<?php include "head.php"; ?>
<title>Buy now Your Favorite Dish.</title>
<?php include "header.php"; ?>


<?php



if (isset($_GET['addtocart'])) {

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>';
        echo '<strong>Success : </strong> Successfully Added To <a href = "cart.php">Cart</a>';
        
        echo ' </strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    
}

?>


<div class="offerimage">
    <img src="images/offer.png" alt="offer">
</div>




<div class="foodlists">
    <?php
    
    $sql = $conn->prepare("SELECT * FROM `mstitem`");

    $sql->execute();


    foreach ($sql->fetchAll() as $row) {


        echo '<div class="foodlist">
    <div class="foodimage">
        <img src="images/paneer.jpg" alt="">
    </div>
    <div class="foodname">
        <h3>' . $row["itemname"] . '</h3>
        <p>Rs' . $row["rate"] . '</p>
    </div>
    <div class="foodbutton">
        
        <a href="addtocart.php?item='.$row["id"].'" class="btn1">Add to Cart</a>
    </div>
</div>';
    }



    ?>



</div>






<?php include "footer.php"; ?>