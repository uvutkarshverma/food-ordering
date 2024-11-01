<?php include "include/config.php"; ?>

<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: food.php?message=loginsuccess');
    exit;
}
if (isset($_POST["submit"])) {
    extract($_POST);

    if ($name == "") {
        $error[] = "Please Enter Your name";
    }
    if ($username == "") {
        $error[] = "Please Enter Your Username";
    }
    if ($email == "") {
        $error[] = "Please Enter Your Email";
    }

    if ($password == "") {
        $error[] = "Please enter password";
    }

    if (!isset($error)) {
        try {
            //add to database
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = $conn->prepare('INSERT INTO  mstcustomer (email, username, custname, password) VALUES (:email, :username, :name, :hash)');

            $sql->execute(array(
                ':name' => $name,
                ':email' => $email,
                ':username' =>  $username,

                ':hash' => $hash,
            ));
            header('Location: login.php?SignUp=success');
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>






<?php include "head.php"; ?>
<title>Sign for new account</title>
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

?>


<div class=" login">
    <div>
        <h1>Welcome to Food Land</h1>
    </div>

    <div>
        <form action="" class="loginform" method="POST">

            <input type="text" id="username" name="username" placeholder="Username">
            <input type="text" id="name" name="name" placeholder="Your name">
            <input type="email" id="Email" name="email" placeholder="Email">


            <input type="password" id="password" name="password" placeholder="Password">

            <button class="btn1" name="submit">Create Your Account</button>
        </form>
    </div>

</div>









<?php include "footer.php"; ?>