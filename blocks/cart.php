<div class="bg_div">
    <h1>Корзина</h1><a href="/index.php?p=checkout" class="button btn_top" style="margin-right:8px;">Оформить</a>

    <?php
        $summary = 0;
        foreach ($_SESSION['cart']['packes'] as $packNumber => $pack)
        {
        ?>
            <div class="bg_div_cont">
                <h4><?=isset($pack['tariff'])?stripslashes($pack['tariff']['name']):'Без тарифа'?></h4>
                <table class="info_table" border="0" cellspacing="0" cellpadding="10" align="center">
<?php
                    if (isset($pack['tariff']))
                    {
                        $summary += $pack['tariff'][1];
                        $summary += 500;
?>
                        <tr>
                            <td class="first">Абонентская плата</td>
                            <td class="last"><?=$pack['tariff'][1]?> руб.</td>
                        </tr>
                        <tr>
                            <td class="first">Минимальный первоначальный взнос</td>
                            <td class="last">500 руб.</td>
                        </tr>
<?php
                    }

                    if (isset($pack['phone']))
                    {
                        $summary += $pack['phone']['cost'];
?>
                        <tr>
                            <td class="first"><?=stripslashes($pack['phone']['number']);?></td>
                            <td class="last"><?=$pack['phone']['cost']?></td>
                        </tr>
<?php
                    }
?>



                </table>
            </div>
<?php
        }
?>
    <div class="gray_line"><h3>Итого: <?=$summary?> руб.</h3><a href="/index.php?p=checkout" class="button btn_bottom">Оформить</a></div>
</div>