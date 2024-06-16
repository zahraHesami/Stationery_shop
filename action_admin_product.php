<?php
include("heder.php");
if (!(isset($_SESSION['state_login']) && $_SESSION['state_login'] === true &&
    ($_SESSION['user_type'] == "admin"))) {
    ?>
    <script type="text/javascript">
        location.replace("index.php")
    </script>
    <?php
}
if (!(isset($_GET['action']) && $_GET['action'] == 'DELETE')) {
    if (isset($_POST['pro_code']) &&
        !empty($_POST['pro_code']) &&
        isset($_POST['pro_name']) &&
        !empty($_POST['pro_name']) && isset($_POST['pro_qty']) &&
        !empty($_POST['pro_qty']) && isset($_POST['pro_price']) &&
        !empty($_POST['pro_price']) && isset($_POST['pro_img']) &&
        !empty($_POST['pro_img']) && isset($_POST['pro_detail']) &&
        !empty($_POST['pro_detail'])
    ) {
        exit("برخی از فیلد ها مقدار دهی نشده اند");
    } else {
        $pro_code = $_POST['pro_code'];
        $pro_name = $_POST['pro_name'];
        $pro_qty = $_POST['pro_qty'];
        $pro_price = $_POST['pro_price'];
        $pro_img = $_FILES['pro_img']['name'];
        $pro_detail = $_POST['pro_detail'];

    }
}
$link = mysqli_connect("localhost", "root", "", "shop_db");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());
if (isset($_GET['action'])) {

    $id = $_GET['id'];

    switch ($_GET['action']) {
        case 'EDIT':
            $query = "UPDATE product SET  pro_code='$pro_code',  pro_name='$pro_name',  pro_qty='$pro_qty',
             pro_price='$pro_price', pro_detail='$pro_detail'   WHERE pro_code='$id'";

            if (mysqli_query($link, $query) === true)
                echo("<p style='color:green;'><b>محصول انتخاب شده با موفقيت ويرايش شد</b></p>");
            else
                echo("<p style='color:red;'><b>خطا در ويرايش محصول</b></p>");

            break;

        case 'DELETE':
            $query = "SELECT pro_img  FROM product
             WHERE pro_code='$id'";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
            $pro_image = $row['pro_img'];

            $query = "DELETE  FROM product
             WHERE pro_code='$id'";

            if (mysqli_query($link, $query) === true) {
                $t_dir = '';
                $pr_code = (int)$id;
                switch ($pr_code) {
                    case $pr_code > 1000 && $pr_code < 2000:
                        $t_dir = "img/product/notebook/" . $row["pro_img"];
                        break;
                    case $pr_code > 2000 && $pr_code < 3000:
                        $t_dir = "img/product/pen/" . $row["pro_img"];
                        break;
                    case $pr_code > 3000 && $pr_code < 4000:
                        $t_dir = "img/product/pencil/" . $row["pro_img"];
                        break;
                    case $pr_code > 4000 && $pr_code < 5000:
                        $t_dir = "img/product/pencilcase/" . $row["pro_img"];
                        break;
                    default:
                        $t_dir = "img/product/" . $row["pro_img"];
                }
                echo("<p style='color:green;'><b>محصول انتخاب شده با موفقيت حذف شد</b></p>");
                unlink($t_dir);
            } else
                echo("<p style='color:red;'><b>خطا در حذف محصول</b></p>");

            break;

    }
    mysqli_close($link);
    include("footer.php");
    exit();

}

$pr_code = (int)$pro_code;
switch ($pr_code) {
    case $pr_code > 1000 && $pr_code < 2000:
        $target_dir = "img/product/notebook/";
        break;
    case $pr_code > 2000 && $pr_code < 3000:
        $target_dir = "img/product/pen/";
        break;
    case $pr_code > 3000 && $pr_code < 4000:
        $target_dir = "img/product/pencil/";
        break;
    case $pr_code > 4000 && $pr_code < 5000:
        $target_dir = "img/product/pencilcase/";
        break;
    default:
        $target_dir = "img/product/";
}

$target_file = $target_dir . $_FILES["pro_img"]["name"];
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$check = getimagesize($_FILES["pro_img"]["tmp_name"]);
if ($check !== false) {
    echo("پرونده انتخابی یک فایل از نوع  " . $check["mime"] . "است<br>");
    $uploadOk = 1;
} else {
    echo("پرونده انتخابی فایل نیست <br> ");
    $uploadOk = 0;
}
if (file_exists($target_file)) {
    echo("این فایل از قبل وجود دارد <br>");
    $uploadOk = 0;
}
if ($_FILES["pro_img"]["size"] > (500 * 1024)) {
    echo("حجم فایل بیشتر از 500 کیلوبایت است <br>");
    $uploadOk = 0;
}
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo("پسوند فایل غیر مجاز است <br>");
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo("فایل ارسال نشد <br>");
} else {
    if (move_uploaded_file($_FILES["pro_img"]["tmp_name"], $target_file)) {
        echo("پرونده " . $_FILES["pro_img"]["name"] . "با موفقیت ارسال شد");
    } else {
        echo("خطا در ارسال فایل  رخ داده است <br>");
    }
}

$link = mysqli_connect("localhost", "root", "", "shop_db");
if (mysqli_connect_errno()) {
    exit("خطایی با شرح زیر رخ داده است" . mysqli_connect_error());
}

if ($uploadOk == 1) {
    $query = "INSERT INTO product (pro_code,pro_name,pro_qty,pro_price,pro_img,pro_detail)
                    VALUES ('$pro_code','$pro_name','$pro_qty','$pro_price','$pro_img','$pro_detail')";
    if (mysqli_query($link, $query)) {
        echo("<p style='color:green;'> کالا با موفقیت ثبت شد</p>");
    } else {
        echo("<p style='color:red;'> خطا در ثبت مشخصات کالا</p> <br>");
    }

} else
    echo("<p style='color:red;'> خطا در ثبت مشخصات کالا</p>  <br>");
mysqli_close($link);
?>

