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

?>

<br/>

<?php

$query = "SELECT * FROM orders";
$result = mysqli_query($link, $query);

?>

<table class="ordertable">

    <thead>
    <th>كد سفارش</th>
    <th>نام خریدار</th>
    <th>نام محصول</th>
    <th>تاریخ سفارش</th>
    <th>تعداد سفارش</th>
    <th>قيمت كالا</th>
    <th>قیمت نهایی</th>
    <th>شماره تماس</th>
    <th>آدرس</th>
    <th>کد مرسوله پستی</th>
    <th>وضعیت سفارش</th>
    <th colspan="3">ابزار مديريتي</th>
    </thead>

    <?php
    while ($row = mysqli_fetch_array($result)) {
        ?>

        <tr>
            <td><?php echo($row['id']) ?></td>
            <td>
                <?php
                $query = "SELECT * FROM users  WHERE username='{$row['username']}'";
                $result2 = mysqli_query($link, $query);
                $row_user = mysqli_fetch_array($result2);
                echo($row_user['firstname'])
                ?>
            </td>
            <td>
                <?php
                $query = "SELECT * FROM product WHERE pro_code='{$row['pro_code']}'";
                $result2 = mysqli_query($link, $query);
                $row_product = mysqli_fetch_array($result2);
                echo($row_product['pro_name'])
                ?>
            </td>
            <td><?php echo($row['orderdate']) ?></td>
            <td><?php echo($row['pro_qty']) ?></td>
            <td><?php echo($row['pro_price']) ?>&nbsp; تومان</td>
            <td>
                <?php
                echo($row['pro_qty'] * $row['pro_price']);
                ?>
                &nbsp; تومان
            </td>


            <td><?php echo($row['mobile']) ?></td>
            <td><?php echo($row['address']) ?></td>
            <td><?php echo($row['trackcode']) ?></td>
            <td
            ">
            <?php
            switch ($row['state']) {
                case 0:
                    echo("تحت بررسی");
                    break;
                case 1:
                    echo("آماده برای ارسال");
                    break;
                case 2:
                    echo("ارسال شده ");
                    break;
                case 3:
                    echo("سفارش لغو شده است");
                    break;
            }
            ?>
            </td>

            <td colspan="3">
                <b><a href="action_admin_manage.php?id=<?php echo($row['id']) ?>&action=BARASI"
                      style="text-decoration: none;">تحت بررسی</a></b>
                </br>
                <b><a href="action_admin_manage.php?id=<?php echo($row['id']) ?>&action=AMADEHERSAL"
                      style="text-decoration: none;">آماده برای ارسال</a></b>

                </br>

                <b><a href="action_admin_manage.php<?php echo($row['id']) ?>&action=ERSALSHODEH"
                      style="text-decoration: none;">ارسال شده</a></b>
                </br>
                <b><a href="action_admin_manage.php?id=<?php echo($row['id']) ?>&action=LAGHV"
                      style="text-decoration: none;">سفارش لغو شده</a></b>
            </td>


        </tr>

        <?php
    }
    ?>

</table>

<?php
include("footer.php");
?>

