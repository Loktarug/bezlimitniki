<?php


$phoneLogoArray = array(1=> 'logotip_beeline.png', 2=> 'logotip_megafon.png', 3=>'logotip_mts.png');

if (isset($_REQUEST['opid']))
{
    $structureDirect['idOperator'] = $_REQUEST['opid'];
    $structureDirect['numberType'] = 2;
    $phonesDirect = dbGetPhonesByOperator($structureDirect);

    $structureFederal['idOperator'] = $_REQUEST['opid'];
    $structureFederal['numberType'] = 1;
    $phonesFederal = dbGetPhonesByOperator($structureFederal);
}
else
{
    $structureDirect['numberType'] = 2;
    $phonesDirect = dbGetPhones($structureDirect);

    $structureFederal['numberType'] = 1;
    $phonesFederal = dbGetPhones($structureFederal);
}

?>
<div class="gray_line">
    <a href="/index.php?p=numbers&opid=1" class="beeline_link">Билайн</a>
    <a href="/index.php?p=numbers&opid=2" class="megagon_link">Мегафон</a>
    <a href="/index.php?p=numbers&opid=3" class="mts_link">МТС</a>
    <a href="/index.php?p=numbers">ВСЕ</a>
</div>

<table class="number_table" border="0" cellspacing="0" cellpadding="5" align="left">
<caption>
	Прямые номера
</caption>

<?php
    foreach ($phonesDirect as $numberint=>$phone)
    {
        ?>

    <tr>
        <td><img src="images/<?=$phoneLogoArray[$phone['idOperator']]?>" border="0" /></td>
        <td><?=$phone['number']?></td>
        <td><?=$phone['cost']?> руб.</td>
    <td align="right"><a href="/index.php?<?=isset($_GET['p'])?'p='.$_GET['p'].'&':''?><?=isset($_GET['tariff'])?'tariff='.$_GET['tariff'].'&':''?><?=isset($_GET['opid'])?'opid='.$_GET['opid'].'&':''?>buy=phone&number=<?=$numberint?>">Купить</a></td>
    </tr>
        <?php
    }
?>
</table>

<table class="number_table" border="0" cellspacing="0" cellpadding="5" align="right">
<caption>
	Федеральные номера
</caption>
    <?php
        foreach ($phonesFederal as $numberint=>$phone)
        {
            ?>


        <tr>
            <td><img src="images/<?=$phoneLogoArray[$phone['idOperator']]?>" border="0" /></td>
            <td><?=$phone['number']?></td>
            <td><?=$phone['cost']?> руб.</td>
        <td align="right"><a href="/index.php?<?=isset($_GET['p'])?'p='.$_GET['p'].'&':''?><?=isset($_GET['tariff'])?'tariff='.$_GET['tariff'].'&':''?><?=isset($_GET['opid'])?'opid='.$_GET['opid'].'&':''?>buy=phone&number=<?=$numberint?>">Купить</a></td>
        </tr>
            <?php
        }
    ?>
</table>
<div class="clear"></div>
<style>.page_buttons{width:300px;}</style>
<div class="page_buttons" align="center">
    <a href="#" class="activ">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">5</a>
    <a href="#">6</a>
    <a href="#">7</a>
</div>
