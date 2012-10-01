<?php
include_once ("paramloader.php");
include_once ("engine/dbOpeations.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
    <title>Сотовые номера</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-21128071-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>

</head>

<body>
<table width=100% cellspacing=1 cellpadding=15 bgcolor=000000>
    <tr><td bgcolor=ffffff><a href=index.php?id=5&opid=3><img src=images/mts_smalllogo.jpg></a><a href=index.php?id=5&opid=1><img src=images/beeline_smalllogo.jpg></a><a href=index.php?id=5&opid=2><img src=images/megafon_smalllogo.jpg></a></td></tr>
    <tr>
        <td bgcolor=ffffff>
            <?php

            $result = mysql_query($select_tariff_header);
            $num = mysql_num_rows($result);
            for ($i=0; $i<$num; $i++)
            {
                $tariffInfo['name'] = mysql_result($result, $i, 'name');
                $tariffInfo['isDirect'] = mysql_result($result, $i, 'isDirect');
                $tariffInfo['isFederal'] = mysql_result($result, $i, 'isFederal');
                $tariffInfo['withPhone'] = mysql_result($result, $i, 'withPhone');
                $tariff[mysql_result($result, $i, 'idOperator')][mysql_result($result, $i, 'idTariff')] = $tariffInfo;

            }

            $tariff['4']['1']['name']="Teletie";
            $tariff['4']['1']['isDirect'] = 0;
            $tariff['4']['1']['isFederal'] = 1;
            $tariff['4']['1']['withPhone'] = 0;




            if ($_REQUEST['go'])
            {
                $Name = $_REQUEST['name']; //senders name
                $email = $_REQUEST['email']; //senders e-mail adress
                $recipient = "mihail614@gmail.com"; //recipient
                $mail_body = "";

                foreach ($_SESSION['groups'] as $key => $value)
                {
                    $mail_body .= "Number: ".$value['phone']['number']."\n Name: ".$_REQUEST['name']."\n Tarrif: ".$value['tariff']['name']."\n Telephone: ".$_REQUEST['tnumber']."\n"; //mail body
                }

                $subject = "I have to buy telephone number"; //subject
                $header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields

                mail($recipient, $subject, $mail_body, $header); //mail command :)

                $recipient = "tarasovsr@gmail.com"; //recipient
                mail($recipient, $subject, $mail_body, $header);
                mysql_query("INSERT INTO  `order` (`body`) VALUES ('".$mail_body."')");
                break;
                session_unset();
            }
            ?>
            <form name="" action="basket.php" method="GET">
                <table cellspacing=5 cellpadding=5 border=0 width=800>
                    <?php
                    $summ=250;
                    foreach ($_SESSION['groups'] as $key => $value)
                    {
                        $summ+=$value['tariff']['minimalPay'];
                        $summ+=$value['tariff']['payForConnection'];
                        $summ+=$value['phone']['cost'];

                        ?>
                        <tr>
                            <td width=20%> <p class=tParametr>Номер телефона:</p></td>
                            <td width=50%>


                                <?php
                                echo $value['phone']['number'];
                                ?>
                            </td>
                            <td width=30%> <p class=tParametr><?php echo $value['phone']['cost']." руб";?></p></td>
                        </tr>
                        <?php

                        ?>
                        <tr>
                            <td><p class=tParametr>Тариф:</p></td>
                            <td>

                                <?php echo $value['tariff']['name'] ?>

                            </td>
                            <td> <p class=tParametr><?php echo "Минимальный обязательный платеж: + ".$value['tariff']['minimalPay']." руб <br>";?><?php echo "Плата за подключение: + ".$value['tariff']['payForConnection']." руб";?></p></td>

                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td><p class=tParametr>Курьерская служба <font color=ff5555>*</font></p></td>
                        <td>Доставка по Москве (в пределах МКАД)</td>
                        <td>+ 250 руб</td>
                    </tr>
                    <tr>
                        <td><p class=tParametr>ФИО:</p></td>
                        <td><input name="name" type="text" value=""></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><p class=tParametr>E-mail:</p></td>
                        <td><input name="email" type="text" value=""></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><p class=tParametr>Телефон:</p></td>
                        <td><input name="tnumber" type="text" value=""></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><p class=tParametr>Сумма заказа:</p></td>
                        <td><?php echo $summ." руб."; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan=3 align=center><input name="buynumber" type="hidden" value="<?php print_r ($_SESSION); ?>">
                            <input class=tsubmit name="go" type="submit" value="Отправить"></td>
                    </tr>
                    <tr>
                        <td colspan=3><font color=ff5555>*</font> при заказе нескольких телефонных номеров, доставка оплачивает один раз</td>
                    </tr>

                </table>


            </form>

        </td></tr>

</table>

<!-- Yandex.Metrika counter -->
<div style="display:none;"><script type="text/javascript">
    (function(w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter6244528 = new Ya.Metrika({id:6244528,
                    clickmap:true,
                    trackLinks:true});
            }
            catch(e) { }
        });
    })(window, 'yandex_metrika_callbacks');
</script></div>
<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer="defer"></script>
<noscript><div><img src="//mc.yandex.ru/watch/6244528" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>

</html>