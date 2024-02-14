<?php

include("../dbConfig.php");

$msg = false;

$id = $_GET['id'];

if ($id) {
    $fetch_image = "SELECT product_img FROM products WHERE id = '$id'";
    $result = mysqli_query($conn, $fetch_image);
    $data = mysqli_fetch_assoc($result);
    $image_path = $data['product_img'];

    $query = "DELETE FROM products WHERE id = '$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $msg = "Product deleted successfully";
        header('Location: ../dashboard.php');
    } else {
        $msg = "Product failed to delete";
        header('Location: ../dashboard.php?error=' . urlencode($msg));
    }
}
