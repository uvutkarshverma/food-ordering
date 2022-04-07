<?php 

date_default_timezone_set('Asia/Kolkata');
include "include/config.php";
session_start(); 

?>
<?php include "head.php"; ?>
<title>COnfirmation page </title>
<?php include "header.php"; ?>

<?php
$email = $_SESSION['email'];
$sql = $conn->prepare("SELECT * FROM `cart` WHERE `email` LIKE :email AND `count` > 0");

$sql->execute(array(
    ":email" => $email,
));
foreach ($sql->fetchAll() as $row) {
    $sql1 = $conn->prepare("SELECT * FROM `mstitem` WHERE `id` = :item_id");
    $sql1->execute(array(
        ":item_id" => $row["Item_id"],
    ));
    $row1 = $sql1->fetch();
    $sql2 = $conn->prepare("INSERT INTO `orders` (`itemid`, `qty`, `rate`, `amount`, `emailid`, `createdts`,`delivery_dt`) VALUES (:itemid, :count, :rate, :amount, :email, :date, :delivery)");
    $sql2->execute(array(
        ":itemid"=>$row["Item_id"],
        ":count"=>$row["count"],
        ":rate"=>$row1["rate"],
        ":amount"=>$row["count"]*$row1["rate"],
        ":email"=>$email,
        ":date"=>date('Y-m-d H:i:s'),
        ":delivery"=>date('Y-m-d H:i:s', strtotime("+30 minutes")),
    ));
}
$sql = $conn->prepare("DELETE FROM `cart` WHERE `email` LIKE :email");

$sql->execute(array(
    ":email" => $email,
));

?>










<div class="container-100 login confirm-page">
    <h1>Thanks for Purchasing with us.</h1>
    <h3>Your Order is confirmed and should be deliverd in 30 min.</h3>
    <p><a class="btn1" href="dashboard.php">Proceed to Dashboard</a></p>
</div>








<?php include "footer.php"; ?>