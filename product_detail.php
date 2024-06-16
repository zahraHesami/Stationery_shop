<?php
include("heder.php");
$link = mysqli_connect("localhost", "root", "", "shop_db");
if (mysqli_connect_errno()) {
    exit("خطایی با شرح زیر رخ داده است" . mysqli_connect_error());
}
$pro_code = 0;
if (isset($_GET["id"])) {
    $pro_code = $_GET["id"];
}


$query = "SELECT * FROM `product` WHERE pro_code='$pro_code'";
$result = mysqli_query($link, $query);
?>


<?php

if ($row = mysqli_fetch_array($result))

{

$target_dir = 0;
$pr_code = (int)$pro_code;

switch ($pr_code) {
    case $pr_code > 1000 && $pr_code < 2000:
        $target_dir = "img/product/notebook/" . $row["pro_img"];
        break;
    case $pr_code > 2000 && $pr_code < 3000:
        $target_dir = "img/product/pen/" . $row["pro_img"];
        break;
    case $pr_code > 3000 && $pr_code < 4000:
        $target_dir = "img/product/pencil/" . $row["pro_img"];
        break;
    case $pr_code > 4000 && $pr_code < 5000:
        $target_dir = "img/product/pencilcase/" . $row["pro_img"];
        break;
    default:
        $target_dir = "img/product/" . $row["pro_img"];
}

?>
<div class="box2">


    <pre><?php echo($row['pro_name']) ?></pre>
    <br>

    <img src="<?php echo($target_dir) ?>" alt="product" class="img">

    <div class="price"> قیمت:<?php echo($row['pro_price']) ?></div>
    <div class="quantity">
        <span>تعداد موجودی :<?php echo($row['pro_qty']) ?> </span>
    </div>
    <p>توضیحات :<?php echo($row['pro_detail']) ?></p>
    <br>
    <a href="order.php?id=<?php echo($row['pro_code']) ?>">
        <p class="butlink">افزودن به سبد خرید</p></a>

    <?php
    }
    ?>
</div>


<br>
<br>
<br>


<?php
include("footer.php");
?>
