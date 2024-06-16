<?php
include("heder.php");
if (isset($_SESSION['state_login']) && $_SESSION['state_login'] === true) {
    ?>
    <script type="text/javascript">
        alert(" شما وارد سایت شده اید");
        location.replace("index.php");
    </script>
    <?php
}
?>


<script type="text/javascript">

    function check_empty() {
        var username = '';
        username = document.getElementById("username").value;
        if (username == '')

            alert("نام کاربری مقدار دهی نشده است");

        else {
            var bool = confirm("از صحت اطلاعات وارد شده اطمینان دارید؟");
            if (bool == true) {
                document.register.submit();
            }
        }


    }

</script>

<div class="form">

    <p>ثبت نام </p>

    <form name="register" action="action_register.php" method="post">


        <div class="field_wrap">
            <label>
                نام
            </label>
            <input type="text" name="firstname" id="firstname"/>
        </div>

        <div class="field_wrap">
            <label>
                نام کاربری
            </label>
            <input type="text" name="username" id="username"/>
        </div>


        <div class="field_wrap">
            <label>
                آدرس ایمیل
            </label>
            <input type="email" name="email" id="email"/>
        </div>

        <div class="field_wrap">
            <label>
                رمز عبور
            </label>
            <input type="password" name="password" id="password"/>
        </div>

        <button type="submit" class="button " onclick="check_empty()"/>
        ثبت اطلاعات</button>

    </form>

</div>

<?php

include("footer.php");
?>
