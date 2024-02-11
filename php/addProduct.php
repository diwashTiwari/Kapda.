<?php include("../dbConfig.php") ?>

<?php
if (isset($_POST['add_product_btn'])) {
    if (!empty($_FILES["uploadProductImage"]["name"])) {

        $filename = $_FILES['uploadProductImage']['name'];
        $tempname = $_FILES['uploadProductImage']['tmp_name'];
        $folder = "../images/product/" . $filename;

        move_uploaded_file($tempname, $folder);

        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        $query = "INSERT INTO products (product_img, title, price, description) VALUES ('$folder', '$title', '$price', '" . mysqli_real_escape_string($conn, $description) . "')";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            header('Location: ../index.php');
        } else {
            header('Location: ../dashboard.php');
        }
    } else {
        echo "failed";
    }
}
