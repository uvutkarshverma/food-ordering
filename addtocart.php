<?php
include "include/config.php";
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}
$email = $_SESSION['email'];

$itemId = $_GET["item"];

$sql = $conn->prepare("SELECT * FROM `cart` WHERE `email` LIKE :email AND `Item_id` LIKE :itemId AND `count` >= 0");
$sql->execute(array(
    ":email" => $email,
    ":itemId" => $itemId,
));
$count = $sql->rowCount();
if ($count > 0) {
    $sql = $conn->prepare("UPDATE `cart` SET `count`= count + 1 WHERE `email`= :email AND `Item_id` = :itemId");
    $sql->execute(array(
        ":email" => $email,
        ":itemId" => $itemId,
    ));

    header('Location: food.php?addtocart=success');
}
else{
    
try {
    $sql = $conn->prepare("INSERT INTO `cart` (`email`, `Item_id`,`count`) VALUES (:email, :itemId, 1)");
    $sql->execute(array(
        ":email" => $email,
        ":itemId" => $itemId,
    ));

    header('Location: food.php?addtocart=success');

} catch (PDOException $e) {
    echo $e->getMessage();
}

}










?>
