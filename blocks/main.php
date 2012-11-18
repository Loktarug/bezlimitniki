<div class="container">
    <div id="iview">
        <div data-iview:thumbnail="/img/slider/leaderOnline_thumbs.png" data-iview:image="/img/slider/leaderOnline.png">
            <div class="iview-caption caption1" data-x="100" data-y="300" data-transition="expandDown">Лидер - Онлайн</div>
        </div>
        <div data-iview:thumbnail="/img/slider/bisunessConnect_thumbs.png" data-iview:image="/img/slider/bisunessConnect.png" data-iview:transition="block-drop-random" data-iview:pausetime="2000">
            <div class="iview-caption caption2" data-x="150" data-y="300" data-transition="expandRight">Интернет тариф: Бизнес коннект</div>
        </div>
        <div data-iview:thumbnail="/img/slider/ultima_thumbs.png" data-iview:image="/img/slider/ultima.png">
            <div class="iview-caption caption3" data-x="350" data-y="300" data-transition="expandLeft">Ультима</div>
        </div>
        <div data-iview:thumbnail="/img/slider/country_thumbs.png" data-iview:image="/img/slider/country.png">
            <div class="iview-caption caption1" data-x="100" data-y="300" data-transition="expandDown">Страна на связи</div>
        </div>
        <div data-iview:thumbnail="/img/slider/youth_thumbs.png" data-iview:image="/img/slider/youth.png" data-iview:transition="block-drop-random" data-iview:pausetime="2000">
            <div class="iview-caption caption2" data-x="150" data-y="300" data-transition="expandRight">Молодежный</div>
        </div>

        <div data-iview:thumbnail="/img/slider/general_thumbs.png" data-iview:image="/img/slider/general.png">
            <div class="iview-caption caption3" data-x="350" data-y="300" data-transition="expandLeft">Генеральный Extra-VIP</div>
        </div>

        <div data-iview:thumbnail="/img/slider/4g_thumbs.png" data-iview:image="/img/slider/4g.png">
            <div class="iview-caption caption3" data-x="350" data-y="300" data-transition="expandLeft">Мегафон Онлайн 4G + LTE-модем</div>
        </div>
    </div>
</div>


    </br>



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