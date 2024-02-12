<?php

include("./php/checkLogin.php");

if ($login) {
    header('Location: ./index.php');
    exit();
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="stylesheet" href="../styles/register.css" />
    <?php include("./includes/favicon.php") ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <div class="container">
        <?php include("includes/backBtn.php") ?>

        <div class="form_box">
            <h2>Register</h2>

            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                echo '<div style="padding:8px 12px; margin-top: 20px; border-radius: 4px; background-color: #fef2f0; color: black; border: 1px solid #f2494e"> <i class="fas fa-times" style="margin-right:10px;"></i>' . htmlspecialchars($error) . '</div>';
            }
            ?>

            <form action="/php/registerUser.php" method="POST" enctype="multipart/form-data">

                <div class="image-upload-container">
                    <input type="file" name="uploadUserImage" class="image-upload-input" accept="image/*">
                    <img src="" alt="Image Preview" class="image-preview">
                </div>

                <div class="floating-label">
                    <input type="text" id="firstname" value="Diwash" name="firstname" required>
                    <label for="firstname">First Name:</label>
                </div>

                <div class="floating-label">
                    <input type="text" id="lastname" value="Tiwari" name="lastname" required>
                    <label for="lastname">Last Name:</label>
                </div>

                <div class="floating-label">
                    <input type="email" id="email" value="tdiwash12@gmail.com" name="email" required>
                    <label for="email">Email:</label>
                </div>

                <div class="floating-label">
                    <input type="password" id="password" value="password1234" name="password" required>
                    <label for="password">Password:</label>
                </div>

                <input type="submit" name="register_btn" value="Register" class="submit_btn btn" />

                <div class="form_footer">
                    <p>
                        Already a Member ?
                        <a href="./login.php">login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" defer src="./js/uploadImage.js"></script>
</body>

</html>