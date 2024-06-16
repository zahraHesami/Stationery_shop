<?php
include("heder.php");
if (!(isset($_SESSION['state_login']) && $_SESSION['state_login'] === true)) {
    ?>
    <script type="text/javascript">
        location.replace("index.php")
    </script>
    <?php
}
$pro_code = $_POST['pro_code'];
$pro_name = $_POST['pro_name'];
$pro_qty = $_POST['pro_qty'];
$pro_price = $_POST['pro_price'];
$total_price = $_POST['total_price'];

$realname = $_POST['firstname'];

$email = $_POST['email'];

$mobile = $_POST['mobile'];
$address = $_POST['address'];

$username = $_SESSION['username'];

$link = mysqli_connect("localhost", "root", "", "shop_db");
if (mysqli_connect_errno()) {
    exit("خطایی با شرح زیر رخ داده است" . mysqli_connect_error());
}

$query = "INSERT INTO orders 
    (username,orderdate,pro_code,pro_qty,pro_price,mobile,address,trackcode,state) 
      VALUES( '$username', '" . date('y-m-d') . "', '$pro_code',
       '$pro_qty', '$pro_price', '$mobile', '$address',
       '000000000000000000000000','0')";
if (mysqli_query($link, $query) === true) {
    echo("<p style='color: darkblue'> سفارش شما با موفقیت ثبت شد کاربر عزیز $realname</p>");
    $query = "UPDATE product SET pro_qty=pro_qty-$pro_qty  WHERE pro_code='$pro_code'";
    mysqli_query($link, $query);
} else
    echo("<p style='color: darkred'> در ثبت سفارش شما خطا اتفاق افتاده است کاربر عزیز $realname</p>")
?>

