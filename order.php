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

if (!(isset($_SESSION['state_login']) && $_SESSION['state_login'] === true)) {
    ?>

    <br>
    <p> برای خرید محصولات باید وارد سایت شوید</p>
    <br>
    <p> در صورتی که عضو فروشگاه هستید برای ورود</p>
    <a href="login.php"><p style="color :darkblue">اینجا</p></a>
    <p>کلیک کنید</p>
    <br>
    <p> و در صورتی که عضو سایت نشده اید برای عضویت</p>
    <a href="register.php"><p style="color :darkseagreen">اینجا</p></a>
    <p>کلیک کنید</p>
    <br>

    <?php
    exit();
}
$query1 = "SELECT * FROM `users` WHERE username='{$_SESSION['username']}'";
$result1 = mysqli_query($link, $query1);
$user_row = mysqli_fetch_array($result1);

$query = "SELECT * FROM `product` WHERE pro_code='$pro_code'";
$result = mysqli_query($link, $query);
?>

    <form name="order" action="action_order.php" id="order" method="post" class="box-offer">



<?php
if ($row = mysqli_fetch_array($result)) {
    ?>
    <table class="boxoff">
        <tr>

            <td style="width:22%"> کد کالا</td>
            <td style="width:78%"><input type="text" name="pro_code"
                                         id="pro_code" value="<?php echo($pro_code); ?>" readonly/>
            </td>
        </tr>
        <tr>
            <td style="width:22%"> نام کالا</td>
            <td style="width:78%"><input type="text" name="pro_name"
                                         id="pro_name" value="<?php echo($row['pro_name']); ?>" readonly/>
            </td>
        </tr>
        <tr>
            <td style="width:22%"> تعداد</td>
            <td style="width:78%"><input type="text" name="pro_qty"
                                         id="pro_qty" onchange="calc_price();"/>
            </td>
        </tr>
        <tr>
            <td style="width:22%"> قیمت هر عدد</td>
            <td style="width:78%"><input type="text" name="pro_price"
                                         id="pro_price" value="<?php echo($row['pro_price']); ?>" readonly/>
                تومان
            </td>
        </tr>
        <tr>
            <td style="width:22%"> مبلغ پرداختی</td>
            <td style="width:78%"><input type="text"
                                         id="total_price" name="total_price" value="0" readonly/> تومان
            </td>
        </tr>


        <tr>
            <td style="width:40%"> نام خریدار</td>
            <td style="width:60%"><input type="text" name="firstname"
                                         id="firstname" value="<?php echo($user_row['firstname']); ?>" readonly/>
            </td>
        </tr>
        <tr>
            <td style="width:22%"> آدرس ایمیل</td>
            <td style="width:78%"><input type="text" name="email"
                                         id="email" value="<?php echo($user_row['email']); ?>" readonly/>
            </td>
        </tr>
        <tr>
            <td style="width:22%"> شماره تلفن</td>
            <td style="width:78%"><input type="text" name="mobile"
                                         id="mobile" value="09"/>
            </td>
        </tr>
        <tr>
            <td style="width:22%"> آدرس پستی</td>
            <td style="width:78%"><textarea id="address" name="address" cols="30" rows="3" wrap="virtual"
                                            style="background-color: cornsilk;"> </textarea>
            </td>
        </tr>
        <tr>

            <td><input type="button" value="خرید محصول" onclick="check_input();" class="btn"></
            >
            </td>
        </tr>
        <script type="text/javascript">
            function calc_price() {
                var pro_qty =<?php echo $row['pro_qty'];?>;
                var price = document.getElementById('pro_price').value;
                var count = document.getElementById('pro_qty').value;
                var total_price = 0;


                if (count > pro_qty) {
                    alert("تعداد درخواستی شما بیشتر از موجودی انبار است");
                    document.getElementById('pro_qty').value = 0;
                    count = 0;
                }
                if (count == 0 || count == '')
                    total_price = 0;
                else
                    total_price = count * price;

                document.getElementById('total_price').value = total_price;

            }

            function check_input() {
                var flag = confirm("از صحت اطلاعات وارد شده اطمینان دارید؟");
                if (flag) {
                    var validation = true;
                    var count = document.getElementById('pro_qty').value;
                    var mobile = document.getElementById('mobile').value;
                    var address = document.getElementById('address').value;
                    if (count == 0 || count == '')
                        validation = false;
                    if (mobile.length < 11)
                        validation = false;
                    if (address.length < 15)
                        validation = false;
                    if (validation)
                        document.order.submit();
                    else
                        alert("برخی از ورودی های فرم به درستی پر نشده است");
                }
            }

        </script>
    </table>

    <div class="boxoff " style="margin-right: 700px;">
        <?php


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

        <pre><?php echo($row['pro_name']) ?></pre>
        <br>

        <img src="<?php echo($target_dir) ?>" alt="pencilcase" class="img">

        <div class="price"> قیمت:<?php echo($row['pro_price']) ?></div>
        <div class="quantity">
            <span>تعداد موجودی :<?php echo($row['pro_qty']) ?> </span>
        </div>
        <p>توضیحات :<?php echo($row['pro_detail']) ?></p>
        <br>


    </div>


    </form>
    <?php
}
include("footer.php");
?>