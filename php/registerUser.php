<?php include("../dbConfig.php") ?>

<?php

$error = false;

if (isset($_POST['register_btn'])) {
    if (!empty($_FILES['uploadUserImage']['name']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password'])) {

        $filename = $_FILES['uploadUserImage']['name'];
        $tempname = $_FILES['uploadUserImage']['tmp_name'];
        $folder = "../images/user/" . $filename;

        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $checkUser = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

        if (mysqli_num_rows($checkUser) > 0) {
            $error = "User already exists";
            header('Location: ../register.php?error=' . urlencode($error));
        } else {
            move_uploaded_file($tempname, $folder);

            $query = "INSERT INTO users (user_img, fname, lname, email, password) VALUES ('$folder', '$fname', '$lname', '$email' ,'$password')";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                header('Location: ../login.php');
            } else {
                header('Location: ../register.php');
            }
        }
    } else {
        $error = "Please input all fields";
        header('Location: ../register.php?error=' . urlencode($error));
    }
}
