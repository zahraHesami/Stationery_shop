<?php
include("heder.php");
?>
<?php
if (!isset($_POST['firstname']) || empty($_POST['firstname']) || !isset($_POST['username']) || empty($_POST['username']) || !isset($_POST['password']) || empty($_POST['password']) || !isset($_POST['email']) || empty($_POST['email'])

) {
    exit("برخی از فیلد ها مقدار دهی نشده اند");
} else {
    $firstname = $_POST['firstname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

}
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    exit("لطفا ایمیل معتبر وارد کنید");
}
$link = mysqli_connect("localhost", "root", "", "shop_db");
if (mysqli_connect_errno()) {
    exit("خطایی با شرح زیر رح داده است" . mysqli_connect_error());
}
$query = "INSERT INTO users (firstname, username, password, email,type) VALUES
                ('$firstname','$username','$password','$email',0)";
if (mysqli_query($link, $query) === true) {

    echo(
        $firstname . "گرامی عضویت شما با نام کاربری " . $username . "با موفقیت انجام شد"
    );
} else
    echo("<p>    عضویت شما انجام نشد</p>");
mysqli_close($link);
?>


<?php

include("footer.php");
?>

