<?php include("../dbConfig.php") ?>

<?php
if (isset($_POST['register_btn'])) {
    if (!empty($_FILES["uploadUserImage"]["name"])) {

        $filename = $_FILES['uploadUserImage']['name'];
        $tempname = $_FILES['uploadUserImage']['tmp_name'];
        $folder = "../images/user/" . $filename;

        move_uploaded_file($tempname, $folder);

        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "INSERT INTO users (user_img, fname, lname, email, password) VALUES ('$folder', '$fname', '$lname', '$email' ,'$password')";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            header('Location: ../login.php');
        } else {
            header('Location: ../register.php');
        }
    } else {
        echo "failed";
    }
}
