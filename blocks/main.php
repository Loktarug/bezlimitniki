<div style="height:380px">
    <div id="slider">
        <a href="/index.php?p=tariffs&tariff=3"><img src="/img/slider/leaderOnline.png" width="739" height="341" alt="МТС - Лидер онлайн"/></a>
        <a href="/index.php?p=tariffs&tariff=12"><img src="/img/slider/bisunessConnect.png" width="739" height="341" alt="МТС - Интернет-тариф Бизнес коннект - подключение на micro-sim"/></a>
        <a href="/index.php?p=tariffs&tariff=16"><img src="/img/slider/ultima.png" width="739" height="341" alt="БиЛайн - Ультима"/></a>
        <a href="/index.php?p=tariffs&tariff=20"><img src="/img/slider/country.png" width="739" height="341" alt="БиЛайн - Страна на связи"/></a>
        <a href="/index.php?p=tariffs&tariff=30"><img src="/img/slider/youth.png" width="739" height="341" alt="БиЛайн - Всё включено Молодёжный"/></a>
        <a href="/index.php?p=tariffs&tariff=32"><img src="/img/slider/general.png" width="739" height="341" alt="Мегафон - Генеральный Extra-VIP"/></a>
        <a href="/index.php?p=tariffs&tariff=48"><img src="/img/slider/4g.png" width="739" height="341" alt="Мегафон - Онлайн 4G + LTE-модем"/></a>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#slider').cycle({
    		fx: 'fade'
    	});
    });
    </script>



    </br>

</div>



<?php

    $federalTariffs = dbGetTariffsCommonInfo('federal');
    $directTariffs = dbGetTariffsCommonInfo('direct');


?>


<h2>Тарифы с федеральными номерами</h2>

<table border="0" cellspacing="1" cellpadding="4" class="tariff_list_table">
    <tr>
        <th scope="col" width="45%">Тариф</th>
        <th scope="col"><img src="/images/icons_mont.jpg" title="Абонентская плата в месяц" alt="Абонентская плата в месяц"></th>
        <th scope="col"><img src="/images/icons_sms.jpg" title="Стоимость СМС" alt="Стоимость СМС"/></th>
        <th scope="col"><img src="/images/icons_mms.jpg" title="Стоимость ММС"  alt="Стоимость ММС"/></th>
        <th scope="col"><img src="/images/icons_e.jpg" title="Стоимость Интернета"  alt="Стоимость Интернета"/></th>
    </tr>
<?php
    $i = 0;
    foreach ($federalTariffs as $idTariff => $tariff)
    {
        $spanClass = '';
        switch ($tariff['idOperator'][0])
        {
            case 1:
                $spanClass = 'l_bee';
                break;
            case 2:
                $spanClass = 'l_meg';
                break;
            case 3:
                $spanClass = 'l_mts';
                break;
            default:
                $spanClass = '';

        }
        $grayLine = ($i%2 == 0 ? 'gray_bg' : '');
        echo '  <tr class="'.$grayLine.'" height="50">
                <td><span class="'.$spanClass.'"><a href="index.php?p=tariffs&amp;tariff='.$idTariff.'">'.$tariff['name'].'</a></span></td>
                <td align="center">'.$tariff[1]['value'].' '.($tariff[1]['value']?$tariff['valueType']:'').'</td>
                <td align="center">'.$tariff[3]['value'].' '.($tariff[3]['value']?$tariff['valueType']:'').'</td>
                <td align="center">'.$tariff[4]['value'].' '.($tariff[4]['value']?$tariff['valueType']:'').'</td>
                <td align="center">'.$tariff[5]['value'].' '.($tariff[5]['value']?$tariff['valueType']:'').'</td>
            </tr>';
        $i++;
    }
?>

</table>
<br>

<!--<h2>Тарифы с прямыми номерами</h2>
<table border="0" cellspacing="0" cellpadding="4" class="tariff_list_table">
    <tr>
        <th scope="col" width="25%">Тариф</th>
        <th scope="col"><img src="/images/icons_mont.jpg" title="Абонентская плата в месяц" alt="Абонентская плата в месяц"></th>
        <th scope="col"><img src="/images/icons_sms.jpg" title="Стоимость СМС" alt="Стоимость СМС"/></th>
        <th scope="col"><img src="/images/icons_mms.jpg" title="Стоимость ММС"  alt="Стоимость ММС"/></th>
        <th scope="col"><img src="/images/icons_e.jpg" title="Стоимость Интернета"  alt="Стоимость Интернета"/></th>
        <th scope="col"><img src="/images/icons_time.jpg" title="Разговор после пяти минут"  alt="Разговор после пяти минут"/></th>
        <th scope="col"><img src="/images/icons_option.jpg" title="Опции"  alt="Опции"/></th>
    </tr>
    <?php
        $i = 0;
        foreach ($directTariffs as $idTariff => $tariff)
        {
            $spanClass = '';
            switch ($tariff['idOperator'][0])
            {
                case 1:
                    $spanClass = 'l_bee';
                    break;
                case 2:
                    $spanClass = 'l_meg';
                    break;
                case 3:
                    $spanClass = 'l_mts';
                    break;
                default:
                    $spanClass = '';

            }

            $grayLine = ($i%2 == 0 ? 'gray_bg' : '');

            echo '  <tr class="'.$grayLine.'">
                    <td><span class="'.$spanClass.'"><a href="index.php?p=tariffs&amp;tarrif='.$idTariff.'">'.$tariff['name'].'</a></span></td>
                    <td>'.$tariff[1]['value'].'</td>
                    <td>'.$tariff[3]['value'].'</td>
                    <td>'.$tariff[4]['value'].'</td>
                    <td>'.$tariff[5]['value'].'</td>
                    <td>'.$tariff[6]['value'].'</td>
                    <td>'.$tariff[7]['value'].'</td>
                </tr>';

            $i++;
        }
    ?>
</table>-->