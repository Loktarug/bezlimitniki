<?php
//error_reporting(E_ALL);
include_once('engine/sessions.php');
include_once('engine/globalVariables.php');
include_once('engine/dbOperations.php');
include_once('engine/auxiliaryFunctions.php');
include_once('engine/buttonsReaction.php');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bezlimitniki.ru - Безлимитные тарифы МТС, Мегафон и Билайн</title>
    <meta name="keywords" content="Безлимитные тарифы, МТС, Мегафон, Билайн"/>
    <meta name="description" content="Безлимитные тарифы МТС, Мегафон и Билайн"/>
    <base href=""/>
    <link rel="stylesheet" href="js/SpryAssets/SpryTabbedPanels.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" href="css/slider/slider.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/css/themes/ui-lightness/jquery-ui-1.8.24.custom.css">
    <!-- нужно для таблиц с тарифами -->
    <script src="js/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js">{lang: 'ru'}</script>
    <script type="text/javascript" src="/js/Cycle/cycle.js"></script>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-35419889-1']);
        _gaq.push(['_setDomainName', 'bezlimitniki.ru']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
</head>
<body>
<?php include_once('blocks/modalWindows.php'); ?>
<table id="main" cellspacing="0" cellpadding="0" border="0" align="center">
<tr>
    <td colspan="3">
        <a href="/"><img class="logo" src="images/logo.png" alt="Безлимитники" title="title" border="0"/></a>
        <ul class="top_menu">
            <!--<li><a href="index.php">Главная</a></li>-->
            <li><a href="index.php?p=tariffs&amp;operator=preview">Тарифы</a></li>
            <!--<li><a href="index.php?p=tariffs&amp;top=show">Хиты</a></li>-->
            <li><a href="index.php?p=numbers">Номера</a></li>
            <!--<li><a href="index.php?p=delivery">Как заказать</a></li>-->
            <li><a href="index.php?p=cart">Корзина <?=count($_SESSION['cart']['quantity'])?'('.$_SESSION['cart']['quantity'].')':''?></a></li>
            <li><a href="index.php?p=aboutUs">Контакты</a></li>
        </ul>
        <p><strong><big><big>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8(495) 999 43 93</big></big></strong></p>
    </td>
</tr>
<tr>
    <td colspan="2" id="operators">
        <ul>
            <li><a href="index.php?p=tariffs&amp;opid=1&amp;operator=preview"><img src="images/operators/bee.png" alt="Билайн" border="0"/></a></li>
            <li><a href="index.php?p=tariffs&amp;opid=2&amp;operator=preview"><img src="images/operators/megafon.png" alt="Мегафон" border="0"/></a></li>
            <li><a href="index.php?p=tariffs&amp;opid=3&amp;operator=preview"><img src="images/operators/mts.png" alt="МТС" border="0"/></a></li>
            <!--<li><a href="#"><img src="images/operators/tt.png" alt="Туристические тарифы" border="0"/></a></li>
            <li><a href="#"><img src="images/operators/tele2.png" alt="ТЕЛЕ 2" border="0"/></a></li>-->
            <li><a href="index.php?p=numbers"><img src="images/operators/kn.png" alt="Красивые номера" border="0"/></a></li>
            <li><a href="#"></a></li>
        </ul>
    </td>
    <td rowspan="2" id="right_line" valign="top"><img src="images/right_line_img.jpg" alt=""/></td>
</tr>
<tr>
<td id="left_menu" valign="top">
    <a href="#" class="select_t">Выбрать тариф</a>
    <table border="0" cellspacing="4" cellpadding="2" class="top_cart_2">
        <tr>
            <td valign="bottom"><a href="/index.php?p=cart"><img src="images/cart.png" width="35" height="35" border="0" /></a></td>
            <td valign="bottom">
                <span>Товаров:</span> <i><?=count($_SESSION['cart']['quantity'])?'('.$_SESSION['cart']['quantity'].')':''?></i><br>
                <span>Сумма:</span> <i><?=$_SESSION['cart']['summary']?> руб.</i><br>
            </td>
        </tr>
        <tr>
            <td height="30" colspan="2"><a href="/index.php?p=cart" class="button right">Оформить заказ</a></td>
        </tr>
    </table>
    <div class="clear"></div>

<?php
    //include ('blocks/cart.php');
?>
    <ul>
        <li><a href="index.php?p=numbers">Красивые телефонные номера</a></li>
        <li><a href="index.php?id=3&amp;operator=preview">Лучшие безлимитные тарифы</a></li>
        <!--<li><a href="#">Поддержка пользователей круглосуточно</a></li>
        <li><a href="index.php?id=3&amp;operator=preview">Тарифы с федеральными номерами</a></li>
        <li><a href="index.php?id=3&amp;operator=preview">Тарифы с прямыми номерами</a></li>
        <li><a href="index.php?id=3&amp;operator=preview">Лучшие тарифы</a></li>-->
    </ul>
</td>
<td id="content" valign="top">
<?php
include ("blocks/content.php");
?>

<div class="clear"></div>



<!-- КОНТЕНТ КОНЕЦ -->
</td>
</tr>
</table>
<div id="bottom">
    <div class="center_bottom">
        <ul class="top_menu">
            <li><a href="index.php">Главная</a></li>
            <li><a href="index.php?p=tariffs&amp;operator=preview">Тарифы</a></li>
            <!--<li><a href="index.php?id=4">Хиты</a></li>-->
            <li><a href="index.php?p=numbers">Номера</a></li>
            <!--<li><a href="index.php?id=6">Как заказать</a></li>-->
            <li><a href="index.php?p=cart">Корзина</a></li>
            <li><a href="index.php?p=aboutUs">Контакты</a></li>
            <li><div class="g-plusone" data-href="http://bezlimitniki.ru"></div></li>
        </ul>
    </div>
</div>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter17582197 = new Ya.Metrika({id:17582197, enableAll: true, trackHash:true, webvisor:true});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/17582197" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!--<a href="http://yandex.ru/cy?base=0&amp;host=bezlimitniki.ru"><img src="http://www.yandex.ru/cycounter?bezlimitniki.ru" width="88" height="31" alt="Яндекс цитирования" border="0" /></a>-->
</body>
</html>
