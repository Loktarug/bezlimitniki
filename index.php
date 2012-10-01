<?php
//error_reporting(E_ALL);
include_once('engine/sessions.php');
include_once('engine/globalVariables.php');
include_once('engine/dbOperations.php');
include_once('engine/auxiliaryFunctions.php');
include_once('engine/buttonsReaction.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bezlimitniki.ru</title>
    <meta name="keywords" content="Безлимитные тарифы"/>
    <meta name="description" content="Безлимитные тарифы"/>
    <base href=""/>
    <link rel="stylesheet" href="SpryAssets/SpryTabbedPanels.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" href="slider.css" type="text/css" />

    <!-- нужно для таблиц с тарифами -->
    <script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
    <!-- нужно для слайдера -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
    <script src="http://gsgd.co.uk/sandbox/jquery/easing/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="source/slides.min.jquery.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function(){
            $('#slides').slides({
                preload: true,
                preloadImage: 'img/loading.gif',
                play: 5000,
                pause: 2500,
                hoverPause: true
            });
        });
    </script>
</head>
<body>
<table id="main" cellspacing="0" cellpadding="0" border="0" align="center">
<tr>
    <td colspan="3">
        <a href="/"><img class="logo" src="images/logo.png" alt="Безлимитники" title="title" border="0"/></a>
        <ul class="top_menu">
            <li><a href="index.php">Главная</a></li>
            <li><a href="index.php?p=tariffs&amp;operator=preview">Тарифы</a></li>
            <li><a href="index.php?p=tariffs&amp;top=show">Хиты</a></li>
            <li><a href="index.php?p=numbers">Номера</a></li>
            <li><a href="index.php?p=delivery">Как заказать</a></li>
            <li><a href="index.php?p=cart">Корзина <?=count($_SESSION['cart']['quantity'])?'('.$_SESSION['cart']['quantity'].')':''?></a></li>
            <li><a href="index.php?p=aboutUs">Контакты</a></li>
        </ul>
    </td>
</tr>
<tr>
    <td colspan="2" id="operators">
        <ul>
            <li><a href="index.php?p=tariffs&amp;opid=1&amp;operator=preview"><img src="images/operators/bee.png" alt="Билайн" border="0"/></a></li>
            <li><a href="index.php?p=tariffs&amp;opid=2&amp;operator=preview"><img src="images/operators/megafon.png" alt="Мегафон" border="0"/></a></li>
            <li><a href="index.php?p=tariffs&amp;opid=3&amp;operator=preview"><img src="images/operators/mts.png" alt="МТС" border="0"/></a></li>
            <li><a href="#"><img src="images/operators/tt.png" alt="Туристические тарифы" border="0"/></a></li>
            <li><a href="#"><img src="images/operators/tele2.png" alt="ТЕЛЕ 2" border="0"/></a></li>
            <li><a href="index.php?p=numbers"><img src="images/operators/kn.png" alt="Красивые номера" border="0"/></a></li>
            <li><a href="#"></a></li>
        </ul>
    </td>
    <td rowspan="2" id="right_line" valign="top"><img src="images/right_line_img.jpg" alt=""/></td>
</tr>
<tr>
<td id="left_menu" valign="top">
    <a href="#" class="select_t">Выбрать тариф</a>

<?php
    //include ('blocks/cart.php');
?>
    <ul>
        <li><a href="index.php?p=numbers">Красивые телефонные номера</a></li>
        <li><a href="index.php?id=3&amp;operator=preview">Лучшие безлимитные тарифы</a></li>
        <li><a href="#">Поддержка пользователей круглосуточно</a></li>
        <li><a href="index.php?id=3&amp;operator=preview">Тарифы с федеральными номерами</a></li>
        <li><a href="index.php?id=3&amp;operator=preview">Тарифы с прямыми номерами</a></li>
        <li><a href="index.php?id=3&amp;operator=preview">Лучшие тарифы</a></li>
    </ul>
</td>
<td id="content" valign="top">
<!-- КОНТЕНТ НАЧАЛО -->
<!-- СЛАЙДЕР НАЧАЛО -->
<!--<div id="container">
    <div id="example">
        <img src="img/new-ribbon.png" width="112" height="112" alt="New Ribbon" id="ribbon"/>
        <div id="slides">
            <div class="slides_container">
                <a href="#" title="145.365 - Happy Bokeh Thursday! | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-1.jpg" width="570" height="270" alt="Slide 1"/></a>
                <a href="#" title="Taxi | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-2.jpg" width="570" height="270" alt="Slide 2"/></a>
                <a href="#" title="Happy Bokeh raining Day | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-3.jpg" width="570" height="270" alt="Slide 3"/></a>
                <a href="#" title="We Eat Light | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-4.jpg" width="570" height="270" alt="Slide 4"/></a>
                <a href="#" title="“I must go down to the sea again, to the lonely sea and the sky; and all I ask is a tall ship and a star to steer her by.” | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-5.jpg" width="570" height="270" alt="Slide 5"/></a>
                <a href="#" title="twelve.inch | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-6.jpg" width="570" height="270" alt="Slide 6"/></a>
                <a href="#" title="Save my love for loneliness | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-7.jpg" width="570" height="270" alt="Slide 7"/></a>
            </div>
            <a href="#" class="prev"><img src="img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"/></a>
            <a href="#" class="next"><img src="img/arrow-next.png" width="24" height="43" alt="Arrow Next"/></a>
        </div>
        <img src="img/example-frame.png" width="739" height="341" alt="Example Frame" id="frame"/>
    </div>
</div>-->

<?php
include ("blocks/content.php");
?>

<script type="text/javascript">
    <!--
    var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanelsMTS");
    var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanelsBeeline");
    var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanelsMegafon");
    //-->
</script>
<div class="clear"></div>



<!-- КОНТЕНТ КОНЕЦ -->
</td>
</tr>
</table>
<div id="bottom">
    <div class="center_bottom">
        <ul class="top_menu">
            <li><a href="index.php">Главная</a></li>
            <li><a href="index.php?id=3&amp;operator=preview">Тарифы</a></li>
            <li><a href="index.php?id=4">Хиты</a></li>
            <li><a href="index.php?id=5">Номера</a></li>
            <li><a href="index.php?id=6">Как заказать</a></li>
            <li><a href="">Корзина</a></li>
            <li><a href="index.php?id=7">Контакты</a></li>
        </ul>
    </div>
</div>
</body>
</html>
