<?php
include("../dbConfig.php");

$error = false;

if (isset($_POST['edit_product_btn'])) {
    $id = $_GET['id'];

    if (!empty($_POST['title']) && !empty($_POST['price']) && !empty($_POST['description'])) {
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        if (!empty($_FILES["uploadProductImage"]["name"])) {
            $filename = $_FILES['uploadProductImage']['name'];
            $tempname = $_FILES['uploadProductImage']['tmp_name'];
            $folder = "../images/product/" . $filename;

            if (move_uploaded_file($tempname, $folder)) {
                $query = "UPDATE products SET product_img = '$folder', title = '$title', price = '$price', description = '" . mysqli_real_escape_string($conn, $description) . "' WHERE id = '$id'";
            } else {
                echo "Failed to upload the file.";
            }
        } else {
            $query = "UPDATE products SET title = '$title', price = '$price', description = '" . mysqli_real_escape_string($conn, $description) . "' WHERE id = '$id'";
        }

        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            header('Location: ../index.php');
        } else {
            $error = "Failed to update the product.";
            header('Location: ../register.php?error=' . urlencode($error));
        }
    } else {
        $error = "Please input all fields";
        header('Location: ../register.php?error=' . urlencode($error));
    }
}
