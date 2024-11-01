<?php include "include/config.php"; ?>
<?php include "head.php"; ?>
<?php session_start(); ?>
<title>WELCOME to Food Land</title>
<?php include "header.php"; ?>

<div class=" homeImage">
    <div class="home-heading">
        <div>
            <h1>We belive good food offer great smile.</h1>
        </div>
        <div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni dolore enim ullam ad, eligendi dolorem
                magnam soluta atque perferendis id rerum aut sed minus doloribus, distinctio illum vitae, consequatur
                autem.</p>
        </div>
        <div><a href="food.php" class="btn1 index-main-btn">Order Now</a></div>


    </div>
</div>


<div class=" food-Menu">
    <h1>Our Menu </h1>
    <p>Some Trendy And Popular Food Items

    <div class="foodlists">
    <?php

$sql = $conn->prepare("SELECT * FROM `mstitem` ORDER BY rand() LIMIT 3");

$sql->execute();

$next =  "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
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

</div>

<div class=" about-us">
    <div class="about-us-text">
        <div>
            <h1>About Us</h1>
        </div>
        <div>
            <h3>We Provide Good Food For Your Family!</h3>
        </div>
        <div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio qui tempore aperiam quos libero cum
                laboriosam vero eligendi, aliquam quis alias rem commodi quasi. Enim hic, amet doloremque repellendus
                illum
            </p>
            <p>
                non repellat perferendis beatae, omnis iusto est cum minima eaque sit error in magnam voluptates,
                nostrum
                obcaecati ut blanditiis nisi. Sit quis nesciunt ad deleniti soluta rem explicabo tempora illo, sint,
                consequatur repudiandae est eos repellat invent.</p>
        </div>

    </div>

    <div class="about-us-img"><img src="images/idle.jpg" alt="idle"></div>
</div>




<?php include "footer.php"; ?>