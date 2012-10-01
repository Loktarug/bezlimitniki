<?php
session_start();

include_once ("engine/dbOperations.php");


$result = mysql_query($select_tariff_header);
$num = mysql_num_rows($result);
for ($i=0; $i<$num; $i++)
{
    $tariffInfo['id'] = mysql_result($result, $i, 'id');
    $tariffInfo['opid'] = mysql_result($result, $i, 'idOperator');
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

$result = mysql_query($select_phone.$_REQUEST['id']);
$row = mysql_fetch_assoc($result);
foreach ($row as $key => $value)
{
    $phone[$key] = $value;
}


if ($_REQUEST['s']==1)
{
    $result = select_tariff_pay($_REQUEST['tarrif'],$_REQUEST['opid']);
    $tariff[$_REQUEST['opid']][$_REQUEST['tarrif']]['minimalPay'] = mysql_result($result, 0, 'value');
    $tariff[$_REQUEST['opid']][$_REQUEST['tarrif']]['payForConnection'] = mysql_result($result, 1, 'value');
    //echo "<br><br>".mysql_result($result, 0, 'value')."<br><br>";
    if (!isset($_SESSION['count']))
    {
        $_SESSION['count'] = 0;
    }

    $flag = 1;

    for ($i=0; $i<$_SESSION['count']; $i++)
    {
        $session_tariff_id = $_SESSION['groups'][$i]['tariff']['id'];
        //echo " session_tariff_id = ".$session_tariff_id."<br>";
        $session_phone_opid = $_SESSION['groups'][$i]['phone']['operator'];
        //echo " session_phone_opid = ".$session_phone_opid."<br>";
        $session_phone_is_direct = ($_SESSION['groups'][$i]['phone']['typeOfNumber']==2)?1:0;
        //echo " session_phone_is_direct = ".$session_phone_is_direct."<br>";
        $session_phone_is_federal = ($_SESSION['groups'][$i]['phone']['typeOfNumber']==1)?1:0;
        //echo " session_phone_is_federal = ".$session_phone_is_federal."<br>";
        $tariff_is_direct = $tariff[$_REQUEST['opid']][$_REQUEST['tarrif']]['isDirect'];
        //echo " tariff_is_direct = ".$tariff_is_direct."<br>";
        $tariff_is_federal = $tariff[$_REQUEST['opid']][$_REQUEST['tarrif']]['isFederal'];
        //echo " tariff_is_federal = ".$tariff_is_federal."<br>";


        if (!$session_tariff_id AND $_REQUEST['opid'] == $session_phone_opid AND $tariff_is_direct == $session_phone_is_direct AND $tariff_is_federal == $session_phone_is_federal) //ПЕРЕДЕЛАТЬ IF
        {
            $_SESSION['groups'][$i]['tariff'] = $tariff[$_REQUEST['opid']][$_REQUEST['tarrif']];
            $flag = 0;
            break;
        }

    }
    if ($flag)
    {
        $_SESSION['groups'][$_SESSION['count']]['tariff'] = $tariff[$_REQUEST['opid']][$_REQUEST['tarrif']];
        $_SESSION['count']++;
        //print_r($tariff[$_REQUEST['opid']][$_REQUEST['tarrif']]);
    }
}
elseif ($_REQUEST['s']==2)
{

    if (!isset($_SESSION['count']))
    {
        $_SESSION['count'] = 0;
    }
    $flag = 1;
    for ($i=0; $i<$_SESSION['count']; $i++)
    {
        $session_phone_id = $_SESSION['groups'][$i]['phone']['id'];
        //echo "session_phone_id = ".$session_phone_id."<br>";
        $session_tariff_opid = $_SESSION['groups'][$i]['tariff']['opid'];
        //echo "session_tariff_opid = ".$session_tariff_opid."<br>";
        $session_tariff_is_direct = $_SESSION['groups'][$i]['tariff']['isDirect'];
        //echo "session_tariff_is_direct = ".$session_tariff_is_direct."<br>";
        $session_tariff_is_federal = $_SESSION['groups'][$i]['tariff']['isFederal'];
        //echo "session_tariff_is_federal = ".$session_tariff_is_federal."<br>";
        $phone_opid = $phone['operator'];
        //echo "phone_opid = ".$phone_opid."<br>";
        $phone_is_direct = ($phone['typeOfNumber']==2)?1:0;
        //echo "phone_is_direct = ".$phone_is_direct."<br>";
        $phone_is_federal = ($phone['typeOfNumber']==1)?1:0;
        //echo "phone_is_federal = ".$phone_is_federal."<br>";
        if (!$session_phone_id AND $session_tariff_opid == $phone_opid AND $session_tariff_is_direct == $phone_is_direct AND $session_tariff_is_federal == $phone_is_federal)
        {
            $_SESSION['groups'][$i]['phone'] = $phone;
            $flag = 0;
            break;
        }
    }
    if ($flag)
    {
        $_SESSION['groups'][$_SESSION['count']]['phone'] = $phone;
        $_SESSION['count']++;
    }


}
elseif ($_REQUEST['s']==3)
{

}

//print_r($_SESSION);


?>