<?php

/*
 * CART FUNCTIONS
 */

function addPhone ($phoneNumber)
{
    //$phoneNumber = (int)$phoneNumber;

    //���� ������� �� int -> ������� 0
    //if (!is_int($phoneNumber))
    //    return 0;

    //���� ����� ����� ������� ��� ������ -> ������� 0
    if (in_array($phoneNumber, $_SESSION['cart']['phoneNumbers']))
        return 0;
    else
        array_push($_SESSION['cart']['phoneNumbers'],$phoneNumber);


    //����� �� �������� ���� ������� ��� � ���������� ����� ������
    $phoneInfo = dbGetPhoneByNumberInt(array('numberint' => $phoneNumber));

    foreach ($_SESSION['cart']['packes'] as &$pack)
    {
        //���� ������� �� ���������� � ������, � ����� ������������� ��������� ��������, �� �������� ������� � ����� �� �������
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

    //���� �� ������ ���������� �����, ��������� ����� �����
    array_push($_SESSION['cart']['packes'], array('phone' => $phoneInfo));
    $_SESSION['cart']['quantity']++;
    return 1;
}

function addTariff ($idTariff)
{
    $idTariff = (int)$idTariff;

    //���� ����� �� int -> ������� 0
    if (!is_int($idTariff))
        return 0;

    //����� �� �������� ���� ����� ��� � ���������� ����� ��������
    $tariffInfo = dbGetTariffCommonInfo(array('idTariff' => $idTariff));

    foreach ($_SESSION['cart']['packes'] as &$pack)
    {
        //���� ������� �� ���������� � ������, � ����� ������������� ��������� ��������, �� �������� ������� � ����� �� �������
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

    //���� �� ������ ���������� �����, ��������� ����� �����
    array_push($_SESSION['cart']['packes'], array('tariff' => $tariffInfo));
    $_SESSION['cart']['quantity']++;
    return 1;
}
