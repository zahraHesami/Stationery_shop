<?php
include("heder.php");


$link = mysqli_connect("localhost", "root", "", "shop_db");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());

if (isset($_POST['detail']) && isset($_SESSION['username'])) {
    $detail = $_POST['detail'];
    $username = $_SESSION['username'];
}

$query = "INSERT INTO contact (username,detail) VALUES ('$username','$detail')";

if (mysqli_query($link, $query) === true)
    echo("<pre style='color:green;'>کاربر گرامی پیام شما با موفقیت دریافت شد</pre>");
else
    echo("<pre style='color:red;'> ارسال پیام با خطا مواجه شد </pre>");

mysqli_close($link);

include("footer.php");
?>
