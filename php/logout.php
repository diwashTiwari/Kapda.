<?php
session_start();

echo "logout";

if (isset($_SESSION['loggedInKapda']) && $_SESSION['loggedInKapda'] === true) {
    unset($_SESSION['loggedInKapda']);

    header('Location: ../login.php');
    exit;
} else {
    header('Location: ../index.php');
    exit;
}
