<?php
$tariffInfo = dbGetTariff(array('idTariff' => $_REQUEST['tariff']));
?>

<div class="bg_div">
    <h1><?php echo stripslashes($tariffInfo['name']); ?></h1><a href="/index.php?<?=isset($_GET['p'])?'p='.$_GET['p'].'&':''?><?=isset($_GET['tariff'])?'tariff='.$_GET['tariff'].'&':''?><?=isset($_GET['opid'])?'opid='.$_GET['opid'].'&':''?>buy=tariff" class="button btn_top" style="margin-right:8px;">Купить</a>
    <!--<tr class="header">
        <td align="center" width="80%">
            <h2 class="leftmenu">Тариф - </h2>
        </td>
        <td align="center">
            <a href="/index.php?p=numbers&opid=<?php echo $_REQUEST['opid'];?>&tariff=<?php echo $_REQUEST['tariff'];?>&page=1"></a>
        </td>
    </tr>-->
    <?php
    foreach ($tariffInfo['sections'] as $idSection => $section)
    {
    ?>
        <div class="bg_div_cont">
            <h4><?php echo stripslashes($section['name']);?></h4>
            <table class="info_table" border="0" cellspacing="0" cellpadding="10" align="center">

            <?php
            foreach($section['subSections'] as $idSubSection => $subSection)
            {
            ?>
                <tr>
                    <td class="first"><?php echo stripslashes($subSection['name']);?></td>
                    <?php

                        $newValue = "<table width='100%' height='100%'><tr>";
                        foreach ($subSection['fields'] as $k=>$v)
                            $newValue .= "<td width=".(100/count($subSection['fields']))."% align=center>".stripslashes($v['value'].' '.$v['valueType'])."</td>";
                        $newValue .= "</tr></table>";
                        ?>
                        <td class="last"><?php echo $newValue;?></td>
                </tr>

                <?php
            }
            ?>
            </table>
        </div>
        <?php
    }
    ?>
    <div class="gray_line"><a href="/index.php?<?=isset($_GET['p'])?'p='.$_GET['p'].'&':''?><?=isset($_GET['tariff'])?'tariff='.$_GET['tariff'].'&':''?><?=isset($_GET['opid'])?'opid='.$_GET['opid'].'&':''?>buy=tariff" class="button btn_bottom">Купить</a></div>
</div>


