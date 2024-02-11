<?php

include("../dbConfig.php");

$msg = false;

$id = $_GET['id'];

if ($id) {
    $query = "DELETE FROM products WHERE id = '$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $msg = "Product deleted successfully";
        header('Location: ../dashboard.php');
    } else {
        $msg = "Product failed to delete";
        header('Location: ../dashboard.php?error=' . urlencode($msg));
    }
}
