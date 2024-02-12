<?php

include("../dbConfig.php");

$error = false;

if (isset($_POST['login_btn'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $row = mysqli_fetch_assoc($query_run);
            $num_rows = mysqli_num_rows($query_run);

            $username = $row['fname'] . ' ' . $row['lname'];

            if ($num_rows == 1) {
                session_start();
                $_SESSION['loggedInKapda'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['useremail'] = $row['email'];
                $_SESSION['userImage'] = $row['user_img'];
                header('Location: ../index.php');
                exit();
            } else {
                $error = "Invalid email or password";
                header('Location: ../login.php?error=' . urlencode($error));
                exit();
            }
        } else {
            $error = "Database error";
            header('Location: ../login.php?error=' . urlencode($error));
            exit();
        }
    } else {
        $error = "Please input all fields";
        header('Location: ../login.php?error=' . urlencode($error));
    }
}

mysqli_close($conn);
