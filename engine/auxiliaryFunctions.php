<?php

/*
 * CART FUNCTIONS
 */

function addPhone ($phoneNumber)
{
    //$phoneNumber = (int)$phoneNumber;

    //Если телефон не int -> вернуть 0
    //if (!is_int($phoneNumber))
    //    return 0;

    //Если такой номер телефон уже выбран -> вернуть 0
    if (in_array($phoneNumber, $_SESSION['cart']['phoneNumbers']))
        return 0;
    else
        array_push($_SESSION['cart']['phoneNumbers'],$phoneNumber);


    //Можно ли добавить этот телефон уже к выбранному ранее тарифу
    $phoneInfo = dbGetPhoneByNumberInt(array('numberint' => $phoneNumber));

    foreach ($_SESSION['cart']['packes'] as &$pack)
    {
        //Если телефон не прикреплен к тарифу, и тариф соответствует оператору телефона, то добавить телефон и выйти из функции
        if (!isset($pack['phone']) && $pack['tariff']['idOperator'] == $phoneInfo['idOperator'])
        {
            if (($phoneInfo['numberType'] == 1 && $pack['tariff']['isFederal'] == 1) || ($phoneInfo['numberType'] == 2 && $pack['tariff']['isDirect'] == 1))
            {
                $pack['phone'] = $phoneInfo;
                $_SESSION['cart']['quantity']++;
                return 1;
            }

        }
    }

    //Если не найден подходящий тариф, добавляет новый пакет
    array_push($_SESSION['cart']['packes'], array('phone' => $phoneInfo));
    $_SESSION['cart']['quantity']++;
    return 1;
}

function addTariff ($idTariff)
{
    $idTariff = (int)$idTariff;

    //Если тариф не int -> вернуть 0
    if (!is_int($idTariff))
        return 0;

    //Можно ли добавить этот тариф уже к выбранному ранее телефону
    $tariffInfo = dbGetTariffCommonInfo(array('idTariff' => $idTariff));

    foreach ($_SESSION['cart']['packes'] as &$pack)
    {
        //Если телефон не прикреплен к тарифу, и тариф соответствует оператору телефона, то добавить телефон и выйти из функции
        if (!isset($pack['tariff']) && $pack['phone']['idOperator'] == $tariffInfo['idOperator'])
        {
            if (($tariffInfo['isFederal'] == 1 && $pack['phone']['numberType'] == 1) || ($tariffInfo['isDirect'] == 1 && $pack['phone']['numberType'] == 2))
            {
                $pack['tariff'] = $tariffInfo;
                $_SESSION['cart']['quantity']++;
                return 1;
            }
        }
    }

    //Если не найден подходящий тариф, добавляет новый пакет
    array_push($_SESSION['cart']['packes'], array('tariff' => $tariffInfo));
    $_SESSION['cart']['quantity']++;
    return 1;
}
