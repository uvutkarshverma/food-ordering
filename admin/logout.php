<?php

session_start();
if (isset($_SESSION['admin_user'])) {
    session_destroy();  

    header('Location: login.php?message=loggedOut');
    exit;
}
else{
    header('Location: login.php?message=PleaseLoginFirst');
}
 

header("location:login.php");  



?>