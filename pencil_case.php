<?php
include("heder.php");
?>
<?php
$link = mysqli_connect("localhost", "root", "", "shop_db");
if (mysqli_connect_errno()) {
    exit("خطایی با شرح زیر رخ داده است" . mysqli_connect_error());
}


$query = "SELECT * FROM `product` WHERE pro_code LIKE '4%'";
$result = mysqli_query($link, $query);

?>
    <section class="offerp">
        <div class="box-offer">

            <?php
            $count = 0;
            while ($row = mysqli_fetch_array($result)) {
                $count++;

                ?>
                <div class="boxoff">


                    <pre><?php echo($row['pro_name']) ?></pre>
                    <br>
                    <a href="product_detail.php?id=<?php echo($row['pro_code']) ?>" class="">
                        <img src="img/product/pencilcase/<?php echo($row['pro_img']) ?>" alt="pencilcase"
                             class="img"></a>

                    <div class="price"> قیمت:<?php echo($row['pro_price']) ?></div>
                    <div class="quantity">
                        <span>تعداد موجودی :<?php echo($row['pro_qty']) ?> </span>
                    </div>
                    <a href="product_detail.php?id=<?php echo($row['pro_code']) ?>" class="">
                        <p class="butlink"> توضیحات تکمیلی و خرید</p></a>

                </div>
                <?php
            }
            ?>

        </div>


    </section>


<?php
include("footer.php");
?>