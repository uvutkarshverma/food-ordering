<?php include "head.php"; ?>
<?php include "../include/config.php";
session_start();

if (!isset($_SESSION['admin_user'])) {
    header('Location: login.php');
    exit;

}
?>

<?php
date_default_timezone_set('Asia/Kolkata');
if (isset($_POST["cancel"])) {
    extract($_POST);
    
    try {
        $sql = $conn->prepare("UPDATE `orders` SET `cancelledts` = :date WHERE `orderid` = :orderid");
        $sql->execute(array(
            ":date"=>date('Y-m-d H:i:s'),
            ":orderid"=>$order_id,

        ));
        $message[] = "Your Order has been Cancelled.";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}



?>
<title>Dashboard page </title>
<link type="text/css" rel="stylesheet" href="../css/jquery.dataTables.min.css">
<link type="text/css" rel="stylesheet" href="../css/jquery.dataTables_themeroller">

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
 -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />














<?php include "header.php"; ?>
<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>';
        echo $message;
        echo ' </strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}

?>
<div class="container-100 dashboard">
<h1>Welcome to Admin DashBoard</h1>
</div>


<div class="container-80 dash ">
    <form action="" method="POST" class="date_search">
        <h3>Search Orders</h3>

        <label for="start_date" class=" my-2">Start Date</label>
        <input type="date" name="start_date" id="start_date" class="form-control" />
        
        
        <label for="end_date" class=" my-2">end Date</label>
        <input type="date" name="end_date" id="end_date" class="form-control" />




        <button  name="search-date" id="search"  class="btn1 my-3" >Search</button> 
        </form>


        <table id="datatables" class="display">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Customer Name</th>
                    <th>Item Name </th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Order Date - Time</th>
                    <th style="color:red;">Cancel Date-Time</th>
                    <th>Delivery On</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php

if (isset($_POST["search-date"])) {
    extract($_POST);
    $sql = $conn->prepare("SELECT * FROM `orders` WHERE `createdts` BETWEEN :startdate AND :enddate");

$sql->execute(array(
    ":startdate"=>$start_date,
    ":enddate"=>$end_date,
));

foreach ($sql->fetchAll() as $row) {
    $sql1 = $conn->prepare("SELECT * FROM `mstitem` WHERE `id` = :item_id");
    $sql1->execute(array(
        ":item_id" => $row["itemid"],
    ));
    $row1 = $sql1->fetch();
    echo '
            <tr>
                <td>'.$row["orderid"].'</td>
                <td>'.$row1["itemname"].'</td>
                <td>'.$row["qty"].'</td>
                <td>'.$row["rate"].'</td>
                <td>'.$row["amount"].'</td>
                <td>'.$row["createdts"].'</td>';
                if (is_null($row["cancelledts"]) && $row["delivery_dt"] > date('Y-m-d H:i:s')) {
                    echo '<td ><form class="loginform" action="" method="POST"> <input type="hidden" value="'.$row["orderid"].'" name= "order_id" ><button style="color:red;" name= "cancel" class="btn cancel-order">Cancel Order</button></form></td>';
                }
                elseif(is_null($row["cancelledts"]) && $row["delivery_dt"] < date('Y-m-d H:i:s')){

                    echo '<td>--</td>';
                }
                else{
                    echo  '<td style="color:red;">'.$row["cancelledts"].'</td>';
                }

                if(!is_null($row["cancelledts"])){
                    echo '<td>--</td>';
                }else{
                    echo '<td>'.$row["delivery_dt"].'</td>';
                }
                
                
                
                if(is_null($row["cancelledts"]) && $row["delivery_dt"] < date('Y-m-d H:i:s')){

                    echo '<td>Delivered</td>';
                }
                if(is_null($row["cancelledts"]) && $row["delivery_dt"] > date('Y-m-d H:i:s')){

                    echo '<td>In Transit</td>';
                }
                elseif(!is_null($row["cancelledts"])){
                    echo '<td>Cancelled</td>';
                }

            echo '</tr>';


}

}
else{
  


$sql = $conn->prepare("SELECT * FROM `orders`");

$sql->execute();
foreach ($sql->fetchAll() as $row) {
    $sql1 = $conn->prepare("SELECT itemname FROM `mstitem` WHERE `id` = :item_id");
    $sql1->execute(array(
        ":item_id" => $row["itemid"],
    ));
    $row1 = $sql1->fetch();
    $sql2 = $conn->prepare("SELECT custname FROM `mstcustomer` WHERE `email` = :email");
    $sql2->execute(array(
        ":email" => $row["emailid"],
    ));
    $row2 = $sql2->fetch();
    echo '
            <tr>
                <td>'.$row["orderid"].'</td>
                <td>'.$row2["custname"].'</td>
                <td>'.$row1["itemname"].'</td>
                <td>'.$row["qty"].'</td>
                <td>'.$row["rate"].'</td>
                <td>'.$row["amount"].'</td>
                <td>'.$row["createdts"].'</td>';
                if (is_null($row["cancelledts"]) && $row["delivery_dt"] > date('Y-m-d H:i:s')) {
                    echo '<td ><form class="loginform" action="" method="POST"> <input type="hidden" value="'.$row["orderid"].'" name= "order_id" ><button style="color:red;" name= "cancel" class="btn cancel-order">Cancel Order</button></form></td>';
                }
                elseif(is_null($row["cancelledts"]) && $row["delivery_dt"] < date('Y-m-d H:i:s')){

                    echo '<td>--</td>';
                }
                else{
                    echo  '<td style="color:red;">'.$row["cancelledts"].'</td>';
                }

                if(!is_null($row["cancelledts"])){
                    echo '<td>--</td>';
                }else{
                    echo '<td>'.$row["delivery_dt"].'</td>';
                }
                
                
                
                if(is_null($row["cancelledts"]) && $row["delivery_dt"] < date('Y-m-d H:i:s')){

                    echo '<td>Delivered</td>';
                }
                if(is_null($row["cancelledts"]) && $row["delivery_dt"] > date('Y-m-d H:i:s')){

                    echo '<td>In Transit</td>';
                }
                elseif(!is_null($row["cancelledts"])){
                    echo '<td>Cancelled</td>';
                }

            echo '</tr>';


}
}
?>

            </tbody>
        </table>

</div>

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatables').dataTable({
            "scrollY": "300px",
            "scrollCollapse": true,
            "paging": false,
            "order": [[5, "desc"]]
        });
    });

</script>





<?php include "footer.php"; ?>