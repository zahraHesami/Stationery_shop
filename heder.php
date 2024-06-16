<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بابونه</title>
    <link rel="icon" type="image/x-icon" href="img/icon3.jpg">
    <link href="styleindex.css" type="text/css" rel="stylesheet">
    <link href="loginsignin.css" type="text/css" rel="stylesheet">

</head>
<body>
<div class="header">

    <h1 class="titleh"> لوازم التحریر بابونه</h1>


</div>
<nav class="header-2">
    <ul class="nav-1">
        <li class="li-1"><a href="index.php" class="alink" title="خانه">خانه</a></li>
        <li class="li-2"><a href="register.php" class="alink" title="ثبت نام">ثبت نام</a></li>
        <?php if (isset($_SESSION['state_login']) && $_SESSION['state_login'] === true) {

            ?>
            <li><a href="logout.php" target="_self" title="خروج از سایت" class="alink">
                    خروج از سایت
                    <?php echo($_SESSION['firstname']); ?>
                </a></li>
            <?php
        } else {
            ?>
            <li><a href="login.php" target="_blank" title="ورود" class="alink">
                    ورود</li>
            </a>
            <?php
        }
        ?>

        <li class="li-1"><a href="contact.php" class="alink">ارتباط با ما</a></li>
        <li class="li-1"><a href="index.php#about" class="alink"> درباره ما</a></li>
        <?php
        if (isset($_SESSION['state_login']) && $_SESSION['state_login'] === true &&
            ($_SESSION['user_type'] === "admin")) {
            ?>
            <li class="li-1"><a href="admin_products.php" class="alink"> مدیریت محصولات</a></li>
            <li class="li-1"><a href="admin_order_manage.php" class="alink"> مدیریت سفارشات</a></li>

            <?php
        } else {
            echo("<p>&nbsp</p>");
        }
        ?>

    </ul>
</nav>

