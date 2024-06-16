<?php
include("heder.php");

?>

<?php

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
} else {
    exit("Please enter username and password");

}

$link = mysqli_connect("localhost", "root", "", "shop_db");
if (mysqli_connect_errno()) {
    exit("خطایی با شرح زیر رح داده است" . mysqli_connect_error());
}
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);
if ($row) {
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['state_login'] = true;
    $_SESSION['username'] = $row['username'];
    if ($row['type'] === '0') {
        $_SESSION['user_type'] = "user";

        echo("<p style='color:green;'>{$row['firstname']} به فروشگاه ایران خوش آمدید</p>");
    } elseif ($row['type'] === '1') {
        $_SESSION['user_type'] = "admin";
        ?>
        <script type="text/javascript">
            location.replace("admin_products.php");
        </script>


        <?php
    }
} else {
    echo("<p style='color:red;'>نام کاربری یا کلمه عبور اشتباه می باشد</p>");
}


?>


















<?php
include("footer.php");

?>
