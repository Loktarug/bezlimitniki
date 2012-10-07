<div class="bg_div">
    <h1>Корзина</h1><a href="/index.php?p=checkout" class="button btn_top" style="margin-right:8px;">Оформить</a>

    <?php
        $summary = 0;
        foreach ($_SESSION['cart']['packes'] as $packNumber => $pack)
        {
        ?>
            <div class="bg_div_cont">
                <h4><?=isset($pack['tariff'])?stripslashes($pack['tariff']['name']):'Без тарифа'?><a href="/index.php?p=cart&remove=tariff&pack=<?=$packNumber?>&tariff=<?=$pack['tariff']['id']?>"><img src="/img/fatcow/16x16/cross.png" width="16" height="16" alt="Удалить тариф" align="right"></a></h4>
                <table class="info_table" border="0" cellspacing="0" cellpadding="10" align="center">
<?php
                    if (isset($pack['tariff']))
                    {
?>
                        <tr>
                            <td class="first">Плата за подключение</td>
                            <td class="last"><?=$pack['tariff'][2]?> руб.</td>
                        </tr>
                        <tr>
                            <td class="first">Минимальный первоначальный взнос</td>
                            <td class="last">500 руб.</td>
                        </tr>
<?php
                    }

                    if (isset($pack['phone']))
                    {
?>
                        <tr>
                            <td class="first"><?=stripslashes($pack['phone']['number']);?></td>
                            <td class="last"><?=$pack['phone']['cost']?><a href="/index.php?p=cart&remove=phone&pack=<?=$packNumber?>&number=<?=$pack['phone']['numberint']?>" ><img src="/img/fatcow/16x16/phone_delete.png" width="16" height="16" alt="Удалить номер" align="right"></a></td>
                        </tr>
<?php
                    }
?>



                </table>
            </div>
<?php
        }
?>
    <div class="gray_line"><h3>Итого: <?=$_SESSION['cart']['summary']?> руб.</h3><a href="/index.php?p=checkout" class="button btn_bottom">Оформить</a></div>
</div>