<?php
include("heder.php");
?>
<?php
        $link = mysqli_connect("localhost","root","","shop_db");
        if(mysqli_connect_errno())
        {
            exit("خطایی با شرح زیر رخ داده است" . mysqli_connect_error());
        }


            $query="select * from product";
             $result=  mysqli_query($link, $query);

    ?>
<span class="phead"> دسته بندی محصولات</span>
<section class="category" >



    <div class="box-container">

        <div class="box">
            <img src="img/casecat.jpg" alt="Case" class="img" >

            <a href="pencil_case.php" class="plink"  target="_blank"><p>جامدادی</p></a>
        </div>
        <div class="box">

            <img src="img/notebook19.jpg" alt="Notebook" class="img">

            <a href="notebook.php" class="plink" target="_blank"><p>دفتر و دفترچه</p> </a>
        </div>
        <div class="box">
            <img src="img/pen.jpeg" alt="pen"  class="img" >


            <a href="pen.php" class="plink" target="_blank"><p> خودکار و روان نویس</p></a>
        </div>
        <div class="box">
            <img src="img/penfes.jpg" alt="pencil" class="img" >

            <a href="pencil.php" class="plink" target="_blank">   <p>ماژیک ومداد</p></a>
        </div>

    </div>

</section>

<span class="phead">پرفروش ترین محصولات</span>

<section class="product" id="product">



    <div class="box-container">

        <div class="box">

            <img src="img/case1.jpeg" alt="جامدادی فانتزی" class="img">
            <pre>جامدادی فانتزی</pre>
            <div class="price"> قیمت:55000</div>


        </div>
        <div class="box">

            <img src="img/daftarche.jpeg" alt="دفترچه" class="img">
            <pre>دفترچه</pre>
            <div class="price"> 78000:قیمت</div>

        </div>
        <div class="box">

            <img src="img/hilighter.jpeg" alt="هایلایتر" class="img">
            <pre>   هایلایتر</pre>
            <div class="price"> 84000:قیمت</div>

        </div>
        <div class="box">

            <img src="img/DILIRANG-120-Color-Pencils-1.jpg" alt="مداد رنگی " class="img">
            <pre>مدادرنگی  </pre>
            <div class="price">690000:قیمت</div>

        </div>
        <div class="box">

            <img src="img/Carrot-Mechanical-Pencil.jpg" alt="اتود هویح" class="img">
            <pre>اتود هویج</pre>
            <div class="price"> 66000:قیمت</div>

        </div>

    </div>

</section>




<span class="phead" style=" text-decoration: underline  black;">
     درباره ما
</span>

<p  id="about" style="text-align: right">

    فروشگاه لوازم التحریر بابونه از سال 1390 فعالیت خود را آغاز کرده است
</p>

<br>
<br>


<?php
include("footer.php");

?>
