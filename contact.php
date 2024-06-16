<?php
include("heder.php");
if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true)) {
    ?>
    <script type="text/javascript">
        alert("ابتدا وارد سایت شوید یا ثبت نام کنید")
        location.replace("index.php");

    </script>
    <?php
}

$link = mysqli_connect("localhost", "root", "", "shop_db");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());

$query = "SELECT * FROM users WHERE username='{$_SESSION['username']}'";
$result = mysqli_query($link, $query);
if ($row = mysqli_fetch_array($result)) {

    $realname = $row['firstname'];
    $email = $row['email'];
}


?>


<div class="form">
    <form name="contact" action="action_contact.php" method="POST">


        <div class="field_wrap">
            <label>نام و نام خانودگي </label>
            <input type="text" id="realname" name="realname" value="<?php echo($realname) ?>"/>

        </div>

        <div class="field_wrap">
            <label>آدرس پست الكترونيك </label>
            <input type="text" style="text-align: right;" id="email" name="email" value="<?php echo($email) ?>"/>

        </div>

        <div class="field_wrap">
            <lable class="lable_img">متن پيام</lable>
            <textarea id="detail" name="detail" cols="45" rows="10" wrap="virtual"></textarea>

        </div>

        <input type="submit" value="ارسال" class="btn"/>&nbsp;&nbsp;&nbsp;<input type="reset" value="جديد" class="btn"/>

    </form>
</div>


<?php
include("footer.php");
?>
