<?php include("./dbConfig.php") ?>

<?php

if (!$conn) {
    die("Sorry failed to connect with server" . mysqli_connect_error());
}

$result = mysqli_query($conn, "SHOW DATABASES LIKE '$dbName'");

if (!$result) {
    die("Error checking database existence: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

if ($row === null) {
    $db = "CREATE DATABASE kapda";
}

mysqli_close($conn);

?>

<?php include("./php/checkLogin.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapda</title>
    <link rel="stylesheet" href="./styles/style.css">
    <script defer type="text/javascript" src="./js/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <div class="navbar-content">
                    <a href="./index.php" class="nav-logo">kapda.</a>

                    <ul class="nav-menu">

                        <?php

                        if ($login) {
                        ?>
                            <li><a href="./dashboard.php" class="nav-link">Dashboard</a></li>
                            <li><a href="./php/logout.php" class="nav-link">Logout</a></li>
                            <li><?php
                                echo '<img src=' . $_SESSION['userImage'] . ' class="avatar user_avatar" alt=' . $_SESSION['username'] . '_profile_image' . '/>';
                                ?></li>
                        <?php } else {  ?>
                            <li><a href="./login.php" class="nav-link">
                                    Login</a></li>
                        <?php } ?>

                    </ul>

                    <button class="nav-toggler">
                        <span></span>
                    </button>
                </div>
            </div>
        </nav>

        <div class="container">
            <section class="hero" id="hero">
                <div class="hero-content">
                    <div class="title">Welcome to Kapda</div>
                    <?php
                    if ($login) {
                        $username = $_SESSION['username'];
                        echo '<h2 style="font-size:32px;">' . $username . '</h2>';
                    }
                    ?>
                    <a href="#main" class="btn">Scroll down
                        <i class="fas fa-arrow-down add-icon"></i>
                    </a>
                </div>
            </section>

        </div>
    </header>
    <main id="main">
        <div class="container">
            <div class="product-cards">
                <?php

                include('./dbConfig.php');

                $product = "SELECT * FROM products";
                $product_run = mysqli_query($conn, $product);

                if (mysqli_num_rows($product_run) > 0) {
                    while ($reg_row = mysqli_fetch_array($product_run)) {
                ?>
                        <div class="product-card">
                            <figure class="product-image">
                                <?php
                                echo '<img src=' . $reg_row['product_img'] . ' class="img-responsive" alt=' . $reg_row['title'] . '_image_profile' . '/>';
                                ?>
                            </figure>
                            <div class="product-title"><?php echo $reg_row['title']; ?></div>
                            <div class="product-description"><?php echo $reg_row['description']; ?></div>
                            <div class="product-price">$ <?php echo $reg_row['price']; ?></div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="empty_data">No Products Found</div>
                <?php
                }
                ?>

            </div>
        </div>
    </main>
    <?php include('includes/footer.php') ?>
</body>

</html>