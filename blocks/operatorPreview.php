<?php

$operatorPreview = 'all';
if (isset($_REQUEST['opid']))
{
    $operatorPreview = $_REQUEST['opid'];
}

$structure['isDirect'] = 0;
$structure['isFederal'] = 1;
$tariffsFederal = dbGetTariffsInfoByType($structure);

$structure['isDirect'] = 1;
$structure['isFederal'] = 0;
$tariffsDirect = dbGetTariffsInfoByType($structure);



$beelineTable = '<div id="TabbedPanelsBeeline" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Федеральные</li>
        <li class="TabbedPanelsTab" tabindex="1">Прямые</li>
        <li class="TabbedPanelsTab" tabindex="2">Все</li>
    </ul>
    <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent">';

$megafonTable = '<div id="TabbedPanelsMegafon" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Федеральные</li>
        <li class="TabbedPanelsTab" tabindex="1">Прямые</li>
        <li class="TabbedPanelsTab" tabindex="2">Все</li>
    </ul>
    <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent">';

$mtsTable = '<div id="TabbedPanelsMTS" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Федеральные</li>
        <li class="TabbedPanelsTab" tabindex="1">Прямые</li>
        <li class="TabbedPanelsTab" tabindex="2">Все</li>
    </ul>
    <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent">';

foreach ($tariffsFederal as $idTariff => $tariff)
{
    switch ($tariff['idOperator'][0])
    {
        case 1:
            $beelineTable .= getLi($idTariff, $tariff);
            break;
        case 2:
            $megafonTable .= getLi($idTariff, $tariff);
            break;
        case 3:
            $mtsTable .= getLi($idTariff, $tariff);
            break;
    }
}

$beelineTable .= '</div>
       <div class="TabbedPanelsContent">';

$megafonTable .= '</div>
       <div class="TabbedPanelsContent">';

$mtsTable .= '</div>
       <div class="TabbedPanelsContent">';



foreach ($tariffsDirect as $idTariff => $tariff)
{
    switch ($tariff['idOperator'][0])
    {
        case 1:
            $beelineTable .= getLi($idTariff, $tariff);
            break;
        case 2:
            $megafonTable .= getLi($idTariff, $tariff);
            break;
        case 3:
            $mtsTable .= getLi($idTariff, $tariff);
            break;
    }
}

$beelineTable .= '</div>
       <div class="TabbedPanelsContent">Content 3</div>
     </div>
   </div>
   <script type="text/javascript">
       <!--
       var TabbedPanelsBeeline = new Spry.Widget.TabbedPanels("TabbedPanelsBeeline");
       //-->
   </script>';

$megafonTable .= '</div>
       <div class="TabbedPanelsContent">Content 3</div>
     </div>
   </div>
   <script type="text/javascript">
       <!--
       var TabbedPanelsMegafon = new Spry.Widget.TabbedPanels("TabbedPanelsMegafon");
       //-->
   </script>';



$mtsTable .= '</div>
       <div class="TabbedPanelsContent">Content 3</div>
     </div>
   </div><script type="text/javascript">
       <!--
       var TabbedPanelsMTS = new Spry.Widget.TabbedPanels("TabbedPanelsMTS");
       //-->
   </script>';


switch ($operatorPreview)
{
    case 1:
        echo $beelineTable;
        break;
    case 2:
        echo $megafonTable;
        break;
    case 3:
        echo $mtsTable;
        break;
    case 'all':
    default:
        echo $beelineTable;
        echo $megafonTable;
        echo $mtsTable;
}





function getLi ($id, $tariff)
{
    $imgLogo = '';
    switch ($tariff['idOperator'][0])
    {
        case 1:
            $imgLogo = 'beeline_smalllogo.jpg';
            break;
        case 2:
            $imgLogo = 'megafon_smalllogo.jpg';
            break;
        case 3:
            $imgLogo = 'mts_smalllogo.jpg';
            break;
    }
    return '<table class="tariffs_table_2" border="0" cellspacing="4" cellpadding="4">
                 <tr>
                   <td rowspan="3" class="tt_img_td" valign="top"><a href="#"><img align="center" src="/images/'.$imgLogo.'" alt="'.$tariff['name'].'" width="100" border="0"></a></td>
                   <td class="tt_title"><a href="/index.php?p=tariffs&opid='.$tariff['idOperator'][0].'&tariff='.$id.'">'.$tariff['name'].'</a></td>
                 </tr>
                 <tr>
                   <td class="tt_content">
                   <p>'.$tariff['description'].'</p>
       			</td>
                 </tr>
                 <tr>
                   <td class="tt_details"><a href="/index.php?p=tariffs&opid='.$tariff['idOperator'][0].'&tariff='.$id.'" class="lnk">подробнее</a></td>
                 </tr>
               </table>';
}
