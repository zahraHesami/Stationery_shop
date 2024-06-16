<?php
include("heder.php");
if (!(isset($_SESSION['state_login']) && $_SESSION['state_login'] === true &&
    ($_SESSION['user_type'] == "admin"))) {
    ?>
    <script type="text/javascript" xmlns="http://www.w3.org/1999/html">
        location.replace("index.php")
    </script>
    <?php
}
$link = mysqli_connect("localhost", "root", "", "shop_db");  // اتصال به پايگاه داده shop_db

if (mysqli_connect_errno())
    exit("خطایی با شرح زیر رخ داده است" . mysqli_connect_error());
$url = $pro_code = $pro_name = $pro_qty = $pro_price = $pro_image = $pro_detail = "";

$btn_caption = "افزودن كالا";
if (isset($_GET['action']) && $_GET['action'] == 'EDIT') {
    $id = $_GET['id'];
    $query = "SELECT * FROM product WHERE pro_code='$id'";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($result)) {
        $pro_code = $row['pro_code'];
        $pro_name = $row['pro_name'];
        $pro_qty = $row['pro_qty'];
        $pro_price = $row['pro_price'];
        $pro_image = $row['pro_img'];
        $pro_detail = $row['pro_detail'];
        $url = "?id=$pro_code&action=EDIT";
        $btn_caption = "ويرايش كالا";

    }
}
?>
<script type="text/javascript">

    function check_empty() {
        var username = '';
        username = document.getElementById("pro_name").value;
        if (username == '')

            alert("نام کالا مقدار دهی نشده است");

        else {
            var bool = confirm("از صحت اطلاعات وارد شده اطمینان دارید؟");
            if (bool == true) {
                document.register.submit();
            }
        }


    }

</script>
<div style="position: relative">
    <div class="form_add">

        <p>ثبت محصولات </p>

        <form name="add_product" action="action_admin_product.php<?php if (!empty($url)) echo($url); ?>" method="post"
              enctype="multipart/form-data">

            <div class="field_wrap">
                <label>
                    کدکالا
                </label>
                <input type="text" name="pro_code" id="pro_code" value="<?php echo($pro_code) ?>"/>
            </div>
            <div class="field_wrap">
                <label>
                    نام کالا
                </label>
                <input type="text" name="pro_name" id="pro_name" value="<?php echo($pro_name) ?>"/>
            </div>

            <div class="field_wrap">
                <label>
                    موجودی کالا
                </label>
                <input type="text" name="pro_qty" id="pro_qty" value="<?php echo($pro_qty) ?>"/>
            </div>


            <div class="field_wrap">
                <label>
                    قیمت کالا
                </label>

                <input type="text" name="pro_price" id="pro_price" value="<?php echo($pro_price) ?>"/>
                <lable> تومان</lable>
            </div>

            <div class="field_wrap">
                <label class="lable_img">
                    آپلود تصویر کالا
                </label>
                <input type="file" name="pro_img" id="pro_img" style="text-align: left;"/>
            </div>
            <div class="field_wrap">
                <label class="lable_img">
                    توضیحات تکمیلی کالا
                </label>
                <textarea id="pro_detail" name="pro_detail" cols="45"
                          rows="10" wrap="virtual"> <?php echo($pro_detail) ?>      </textarea>
            </div>


            <input type="submit" class="btn " onclick="check_empty()" value="<?php echo($btn_caption) ?>"/> &nbsp;&nbsp;&nbsp;
            <input type="reset" class="btn" value="جديد"/>
        </form>

    </div>
    <?php

    $query = "SELECT * FROM product";
    $result = mysqli_query($link, $query);

    ?>

    <table class="ordertable" style="width:600px;  margin-right:10px; margin-top: 20px;">
        <thead>
        <th>كد كالا</th>
        <th>نام كالا</th>
        <th>موجودي كالا</th>
        <th>قيمت كالا</th>
        <th>تصوير كالا</th>
        <th>ابزار مديريتي</th>
        </thead>

        <?php


        while ($row = mysqli_fetch_array($result)) {
            $target_dir = '';
            $pr_code = (int)$row["pro_code"];
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

            <tr class="protable">
                <td><?php echo($row['pro_code']) ?></td>
                <td><?php echo($row['pro_name']) ?></td>
                <td><?php echo($row['pro_qty']) ?></td>
                <td><?php echo($row['pro_price']) ?>&nbsp; تومان</td>
                <td><img src="<?php echo($target_dir) ?>" width="150px" height="50px"/></td>
                <td>
                    <b><a href="action_admin_product.php?id=<?php echo($row['pro_code']) ?>&action=DELETE"
                          style="text-decoration: none;">حذف</a></b>
                    &nbsp;|&nbsp;
                    <b><a href="admin_products.php?id=<?php echo($row['pro_code']) ?>&action=EDIT"
                          style="text-decoration: none;">ويرايش</a></b>
                </td>
            </tr>
            <?php
        }
        ?>

    </table>
</div>
<?php
include("footer.php");
?>
