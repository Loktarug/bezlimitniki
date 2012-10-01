<?php
error_reporting(E_ALL);

//connect to DB
mysql_connect('ibolit.mysql','ibolit_mysql','2d7yzjjz') or die('Could not connect: ' . mysql_error());

//select DataBase
$db_selected = mysql_select_db('ibolit_db') or die ('Can\'t use foo : ' . mysql_error());
$query = "SELECT th.*, ts.name, tss.name, tf.value, tf.valueType FROM `tariffsHeader` as th LEFT JOIN `tariffsSection` as ts ON th.idOperator=ts.idOperator LEFT JOIN `tariffsSubSection` as tss ON ts.id=tss.idSection LEFT JOIN tariffsFields as tf ON tf.idSubSection = tss.id WHERE th.idOperator != 3 ORDER BY ts.priority DESC";

$result = mysql_query($query);

$resultQuantity = mysql_num_rows($result);

$headerNames = array();
$sectionName = array();
$subSectionName = array();
$header = array();
$section = array();
$subSection = array();
$values = array();

$numTariff = 19;
$numSection = 307;
$numSubSection = 2593;
$tempHeader = array();

$tempHeader['shortDescription'] = "";
$tempHeader['rank'] = 0;
$tempHeader['withPhone'] = 1;
$tempHeader['actual'] = 1;
for ($i=0; $i<$resultQuantity; $i++)
{
    //tariffs
    $name = mysql_result($result,$i,'th.name');
    if (!array_key_exists($name,$headerNames))
    {
        $tempHeader['idOperator'] = mysql_result($result,$i,'th.idOperator');
        $tempHeader['isDirect'] = mysql_result($result,$i,'th.isDirect');
        $tempHeader['isFederal'] = mysql_result($result,$i,'th.isFederal');
        $tempHeader['name'] = $name;
        $header[$numTariff] = $tempHeader;
        $headerNames[$name] = $numTariff;
        $numTariff++;
    }
    $idTariff = $headerNames[$name];

    //sections
    $sName = mysql_result($result,$i,'ts.name');
    if (@!array_key_exists($sName, $sectionName[$idTariff]))
    {
        $section[$idTariff]['name'][] = $sName;
        $sectionName[$idTariff][$sName] = $numSection;
        $numSection++;
    }

    $idSection = $sectionName[$idTariff][$sName];

    //subSections
    $ssName = mysql_result($result,$i,'tss.name');
    if (@!array_key_exists($ssName, $subSectionName[$idSection]))
    {
        $subSection[$idSection]['name'][] = $ssName;
        $subSectionName[$idSection][$ssName] = $numSubSection;
        $numSubSection++;
    }

    $idSubSection = $subSectionName[$idSection][$ssName];

    //subSections
    $fieldValue[$idSubSection]['value'] = mysql_result($result,$i,'tf.value');
    $fieldValue[$idSubSection]['valueType'] = mysql_result($result,$i,'tf.valueType');

}

//print_r ($value);
$query = "";
foreach ($header as $key=>$value)
{
    $query .= "INSERT INTO `headers` (`id`, `idOperator`, `name`, `isDirect`, `isFederal`, `shortDescription`, `withPhone`, `actual`, `rank`) VALUES  ('".$key."', '".$value['idOperator']."', '".$value['name']."', '".$value['isDirect']."', '".$value['isFederal']."', '".$value['shortDescription']."', '".$value['withPhone']."', '".$value['actual']."', '".$value['rank']."'); ";

}

foreach ($sectionName as $key=>$value)
{
    //print_r ($value);
    $priority = count ($value);
    foreach ($value as $name=>$v)
    {
        $query .= "INSERT INTO `sections` (`id`, `idTariff`, `name`, `priority`) VALUES  ('".$v."', '".$key."', '".$name."', '".$priority."'); ";
        $priority--;
    }

}

foreach ($subSectionName as $key=>$value)
{
    $priority = count ($value);
    foreach ($value as $name=>$v)
    {
        $query .= "INSERT INTO `subSections` (`id`, `idSection`, `name`, `priority`) VALUES  ('".$v."', '".$key."', '".$name."', '".$priority."'); ";
        $priority--;
    }

}

foreach ($fieldValue as $key=>$value)
{
    $query .= "INSERT INTO `fields` (`idSubSection`, `value`, `valueType`, `order`, `priority`, `printAsMain`, `classField`)
                    VALUES  ('".$key."', '".$value['value']."', '".$value['valueType']."', '1', '1', '0', ''); ";

}

print_r ($query);

mysql_query($query);
/**
 * Created by JetBrains PhpStorm.
 * User: Lamer
 * Date: 31.03.12
 * Time: 20:27
 * To change this template use File | Settings | File Templates.
 */