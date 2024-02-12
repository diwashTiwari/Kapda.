<?php

include("./php/checkLogin.php");

if (!$login) {
    header('Location: ./login.php');
    exit();
};

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="stylesheet" href="../styles/dashboard.css" />
    <?php include("./includes/favicon.php") ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <?php include("dbConfig.php") ?>

    <nav class="navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="./index.php" class="go_back btn w-fit">
                    <i class="fas fa-arrow-left back-icon"></i>
                    <h5>Go back</h5>
                </a>

                <button class="btn w-fit add_prod_btn" id="openModalBtn">
                    <h5>Add Product</h5>
                    <i class="fas fa-plus add-icon"></i>
                </button>
            </div>
        </div>
    </nav>

    <section id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="product_box">
                <h2>Add Product</h2>
                <form action="/php/addProduct.php" method="POST" enctype="multipart/form-data">

                    <div class="image-upload-container">
                        <input type="file" name="uploadProductImage" class="image-upload-input" accept="image/*">
                        <img src="" alt="Image Preview" class="image-preview">
                    </div>

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="The LB" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" value="200" min="0" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="4" required>Tis better to have loved and lost than never to have loved at all.</textarea>
                    </div>
                    <input type="submit" name="add_product_btn" class="submit_btn btn" value="Add" />

                </form>
            </div>
        </div>
    </section>

    <section class="container">

        <?php
        if ($login) {
            echo '<div style="display:flex; gap:40px; margin-bottom: 40px;">
                        <img src=' . $_SESSION['userImage'] . ' class="avatar dashboard_avatar" alt=' . $_SESSION['username'] . '_profile_image' . ' style="height:400; width:400;"  />
                        <div>
                            <h2 style="font-size:32px;margin-bottom:0">' . $_SESSION['username'] . '</h2>
                            <h5 style="font-size:24px; font-weight: 500;">' . $_SESSION['useremail'] . '</h5>
                        </div>
                      </div>';
            echo '';
        }
        ?>


        <div class="tab">
            <button class="tablinks btn" id="user_tab_btn" onclick="openTab(event, 'user')">Users</button>
            <button class="tablinks btn" onclick="openTab(event, 'product')">Products</button>
        </div>

        <div id="user" class="tabcontent">
            <h2>User List</h2>

            <?php
            $users = "SELECT * FROM users";
            $users_run = mysqli_query($conn, $users);

            if (mysqli_num_rows($users_run) > 0) {
            ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <!-- <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($reg_row = mysqli_fetch_array($users_run)) { ?>
                                <?php if ($reg_row['email'] != $_SESSION['useremail']) { ?>
                                    <tr>
                                        <td><?php echo $reg_row['id']; ?></td>
                                        <td> <?php
                                                echo '<img src=' . $reg_row['user_img'] . ' class="avatar user_avatar" alt=' . $reg_row['fname'] . '_image_profile' . '/>';
                                                ?></td>
                                        <td><?php echo $reg_row['fname'] . ' ' . $reg_row['lname']; ?></td>
                                        <td><?php echo $reg_row['email']; ?></td>
                                        <!-- <td>
                                        <?php echo '<a href="./php/editUser.php?id=' . $reg_row['id'] . '"> <i class="far fa-edit edit-icon"></i></a>'   ?>
                                        <?php echo '<a href="./php/deleteUser.php?id=' . $reg_row['id'] . '"> <i class="far fa-trash-alt delete-icon"></i></a>'   ?>
                                    </td> -->
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            <?php } else { ?>
                <div class="empty_data">
                    <i class="fas fa-user user-icon"></i>
                    No Users Found
                </div>
            <?php } ?>

        </div>
        <div id="product" class="tabcontent">
            <h2>Product List</h2>

            <?php

            $product = "SELECT * FROM products";
            $product_run = mysqli_query($conn, $product);

            if (mysqli_num_rows($product_run) > 0) {
            ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($reg_row = mysqli_fetch_array($product_run)) { ?>
                                <tr>
                                    <td><?php echo $reg_row['id']; ?></td>
                                    <td> <?php
                                            echo '<img src=' . $reg_row['product_img'] . ' class="avatar product_avatar" alt=' . $reg_row['title'] . '_product_image' . '/>';
                                            ?></td>
                                    <td><?php echo $reg_row['title']; ?></td>
                                    <td><?php echo $reg_row['price']; ?></td>
                                    <td><?php echo $reg_row['description']; ?></td>
                                    <td>
                                        <?php echo '<a href="./php/editProduct.php?id=' . $reg_row['id'] . '"> <i class="far fa-edit edit-icon"></i></a>'   ?>
                                        <?php echo '<a href="./php/deleteProduct.php?id=' . $reg_row['id'] . '"> <i class="far fa-trash-alt delete-icon"></i></a>'   ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            <?php } else { ?>
                <div class="empty_data">No Products Found</div>
            <?php } ?>

        </div>
    </section>

    <?php include('includes/footer.php') ?>

    <script type="text/javascript">
        const modal = document.getElementById("myModal");
        const modalBtn = document.getElementById("openModalBtn");
        const closeBtn = document.getElementsByClassName("close")[0];
        const user_tab_btn = document.getElementById("user_tab_btn");

        modalBtn.addEventListener("click", () => (modal.style.display = "block"));
        closeBtn.addEventListener("click", () => (modal.style.display = "none"));

        window.onclick = (event) => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

        const openTab = (evt, tabName) => {
            let i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");


            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
    <script type="text/javascript" defer src="./js/uploadImage.js"></script>
</body>

</html>