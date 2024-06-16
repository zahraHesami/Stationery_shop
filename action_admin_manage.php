<?php
include("heder.php");
if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] ==
    "admin")) {
    ?>
    <script type="text/javascript">

        location.replace("index.php");

    </script>
    <?php
}

$link = mysqli_connect("localhost", "root", "", "shop_db");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());


if (isset($_GET['action'])) {

    $id = $_GET['id'];

    switch ($_GET['action']) {
        case 'BARASI':
            $state = '0';
            break;
        case 'AMADEHERSAL':
            $state = '1';
            break;
        case 'ERSALSHODEH':
            $state = '2';
            break;
        case 'LAGHV':
            $state = '3';
            break;
        default:
            $state = '0';

    }


    $query = "UPDATE orders SET state='$state' WHERE id='$id'";

    if (!(mysqli_query($link, $query) === true))
        die("<p style='color:red;'><b>خطا در اجرای عملیات درخواست</b></p>");

    mysqli_close($link);

}


?>

<script type="text/javascript">

    location.replace("admin_manage_order.php");

</script>


<?php
include("footer.php");
?>



