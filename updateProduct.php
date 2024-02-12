<?php

include("./dbConfig.php");
include("./php/checkLogin.php");

$id = $_GET['id'];

if (!$login) {
    header('Location: ./index.php');
    exit();
};

$product_run = mysqli_query($conn, "SELECT * FROM products where id = '$id'");

if (!$id || mysqli_num_rows($product_run) === 0) {
    header('Location: ./dashboard.php');
    exit();
};


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="../styles/dashboard.css" />
    <?php include("./includes/favicon.php") ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <nav class="navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="./dashboard.php" class="go_back btn w-fit">
                    <i class="fas fa-arrow-left back-icon"></i>
                    <h5>Go back</h5>
                </a>

            </div>
        </div>
    </nav>

    <div class="container">
        <div style="display: flex; gap:20px">
            <?php

            if (mysqli_num_rows($product_run) > 0) {
                while ($reg_row = mysqli_fetch_array($product_run)) {
            ?>
                    <div class="product-cards">
                        <div class="product-card shadow">
                            <figure class="product-image">
                                <?php
                                echo '<img src=' . $reg_row['product_img'] . ' class="img-responsive" alt=' . $reg_row['title'] . '_image_profile' . '/>';
                                ?>
                            </figure>
                            <div class="product-title"><?php echo $reg_row['title']; ?></div>
                            <div class="product-description"><?php echo $reg_row['description']; ?></div>
                            <div class="product-price">$ <?php echo $reg_row['price']; ?></div>
                        </div>
                    </div>

                    <div class="shadow" style="width: 100%; background-color: #fff; padding: 16px;border-radius: 8px;">
                        <h2>Update Product</h2>
                        <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            echo '<div style="padding:8px 12px; margin-top: 20px; border-radius: 4px; background-color: #fef2f0; color: black; border: 1px solid #f2494e"> <i class="fas fa-times" style="margin-right:10px;"></i>' . htmlspecialchars($error) . '</div>';
                        }
                        ?>
                        <form action="/php/editProduct.php?id=<?php echo $reg_row['id']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="image-upload-container">
                                <input type="file" name="uploadProductImage" class="image-upload-input" accept="image/*">
                                <img src="<?php echo $reg_row['product_img']; ?>" alt="Image Preview" class="image-preview">
                            </div>
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" id="title" name="title" value="<?php echo isset($reg_row['title']) ? $reg_row['title'] : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" id="price" name="price" value="<?php echo isset($reg_row['price']) ? $reg_row['price'] : ''; ?>" min="0" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea id="description" name="description" rows="4" required><?php echo isset($reg_row['description']) ? $reg_row['description'] : ''; ?></textarea>
                            </div>
                            <input type="submit" name="edit_product_btn" class="submit_btn btn" value="Add" />
                        </form>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>