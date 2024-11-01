<?php
session_start();
include "include/config.php";


if (isset($_SESSION['username'])) {
    header('Location: food.php?message=loginsuccess');
    exit;
}
if (isset($_POST["submit"])) {
    extract($_POST);


    if ($username == "") {
        $error[] = "Please Enter Your Username";
    }

    if ($password == "") {
        $error[] = "Please enter password";
    }

    if (!isset($error)) {

        try {
            //add to database


            $sql = $conn->prepare('SELECT username,custname, password,email FROM `mstcustomer` WHERE username = :username');
            $sql->execute(array(
                ":username" => $username,
            ));
            $row = $sql->fetch();
            $hash = password_verify($password, $row["password"]);

            if ($hash) {
                $_SESSION["username"] = $row["username"];
                $_SESSION["name"] = $row["custname"];
                $_SESSION["email"] = $row["email"];
                header('Location: food.php?message=loginsuccess');
                exit;
            } else {
                $error[] = "Wrong Username Or Password";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>

















<?php include "head.php"; ?>
<title>Log in to your account</title>
<?php include "header.php"; ?>
<?php
if (isset($error)) {
    foreach ($error as $error) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>';
        echo $error;
        echo ' </strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}


if (isset($_GET["SignUp"])) {
    
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>';
        echo "Your Account is opened successfully. Please login to Continue!";
        echo ' </strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    
}

?>


<div class=" login">
    <div>
        <h1>Welcome Back</h1>
        
    </div>

    <div>
        <form action="" class="loginform" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password">
            <button class="btn1" name="submit">Sign In</button>
        </form>
    </div>

</div>









<?php include "footer.php"; ?>