<div class="bg_div">
    <h1>Оформление заказа</h1>
    <form action='/index.php' name='checkoutForm' method='POST'>
        <div class="bg_div_cont">
            <h4>Введите ваши контактные данные:</h4>
            <table class="info_table" border="0" cellspacing="0" cellpadding="10" align="center">
                <tr>
                    <td class="first">ФИО:</td>
                    <td class="last"><input name="name" type="text" value=""></td>
                </tr>
                <tr>
                    <td class="first">Ваш E-mail:</td>
                    <td class="last"><input name="email" type="text" value=""></td>
                </tr>
                <tr>
                    <td class="first">Телефон для связи:</td>
                    <td class="last"><input name="tnumber" type="text" value=""></td>
                </tr>
                <tr>
                    <td class="first"></td>
                    <td class="last"><input name="checkoutForm" type="submit" value="Оформить"></td>
                </tr>
            </table>
        </div>
    </form>
</div>









<div class="bg_div">
    <h2>Корзина</h2>

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
</div>