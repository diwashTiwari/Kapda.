<?php
session_start();

if (isset($_SESSION['loggedInKapda']) && $_SESSION['loggedInKapda'] === true) {

    unset($_SESSION['loggedInKapda']);
    unset($_SESSION['username']);
    unset($_SESSION['useremail']);
    unset($_SESSION['userImage']);

    header('Location: ../login.php');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
