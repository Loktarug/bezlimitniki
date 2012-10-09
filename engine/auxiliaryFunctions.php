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

                //Добавляем информацию о последнем добавленном пакете. Это нужно для вывода модального окна
                $_SESSION['cart']['latest'] = $pack;

                $_SESSION['cart']['quantity']++;
                return 1;
            }

        }
    }

    //Если не найден подходящий тариф, добавляет новый пакет
    array_push($_SESSION['cart']['packes'], array('phone' => $phoneInfo));

    //Добавляем информацию о последнем добавленном телефоне. Это нужно для вывода модального окна
    $_SESSION['cart']['latest']['phone'] = $phoneInfo;

    $_SESSION['cart']['quantity']++;
    return 1;
}

function removePhone ($idPack, $phoneNumber)
{
    $idPack = (int)$idPack;
    if (!is_int($idPack))
        return 0;

    if ($_SESSION['cart']['packes'][$idPack]['phone']['numberint'] == $phoneNumber)
    {
        $_SESSION['cart']['quantity']--;
        unset($_SESSION['cart']['phoneNumbers'][array_search($phoneNumber, $_SESSION['cart']['phoneNumbers'])]);
        if (isset($_SESSION['cart']['packes'][$idPack]['tariff']))
            unset ($_SESSION['cart']['packes'][$idPack]['phone']);
        else
            unset ($_SESSION['cart']['packes'][$idPack]);
    }
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

                //Добавляем информацию о последнем добавленном пакете. Это нужно для вывода модального окна
                $_SESSION['cart']['latest'] = $pack;

                $_SESSION['cart']['quantity']++;
                return 1;
            }
        }
    }

    //Если не найден подходящий тариф, добавляет новый пакет
    array_push($_SESSION['cart']['packes'], array('tariff' => $tariffInfo));

    //Добавляем информацию о последнем добавленном тарифе. Это нужно для вывода модального окна
    $_SESSION['cart']['latest']['tariff'] = $tariffInfo;

    $_SESSION['cart']['quantity']++;
    return 1;
}

function removeTariff ($idPack, $idTariff)
{
    $idTariff = (int)$idTariff;
    $idPack = (int)$idPack;

    if (!(is_int($idTariff) && is_int($idPack)))
        return 0;

    if (($_SESSION['cart']['packes'][$idPack]['tariff']['id'] == $idTariff) && $idTariff>0)
    {
        $_SESSION['cart']['quantity']--;
        if (isset($_SESSION['cart']['packes'][$idPack]['phone']))
        {
            $_SESSION['cart']['quantity']--;
            unset($_SESSION['cart']['packes'][$idPack]);
        }
        else
        {
            unset($_SESSION['cart']['packes'][$idPack]);
        }

    }
    else if ($idTariff == '')
    {
        $_SESSION['cart']['quantity']--;
        unset($_SESSION['cart']['packes'][$idPack]);
    }
}


/*
 * MODAL WINDOWS
 */


function printModalWindow($name)
{
    switch ($name)
    {
        case 'addNewTariff':
            echo '<div class="bg_div_cont" id="tariffAdded" title="Вы добавили товар в корзину">';
            break;
        case 'addNewPhone':
            echo '<div class="bg_div_cont" id="phoneAdded" title="Вы добавили товар в корзину">';
            break;
    }
?>
    <h4><?=isset($_SESSION['cart']['latest']['tariff'])?stripslashes($_SESSION['cart']['latest']['tariff']['name']):'Без тарифа'?></h4>
    <table class="info_table" border="0" cellspacing="0" cellpadding="10" align="center">
    <?php
        if (isset($_SESSION['cart']['latest']['tariff']))
        {
    ?>
            <tr>
                <td class="first">Плата за подключение</td>
                <td class="last"><?=$_SESSION['cart']['latest']['tariff'][2]?> руб.</td>
            </tr>
            <tr>
                <td class="first">Минимальный первоначальный взнос</td>
                <td class="last">500 руб.</td>
            </tr>
    <?php
        }
        else
        {
    ?>
            <tr>
                <td class="first"><a href="/index.php?p=tariffs&opid=<?=$_SESSION['cart']['latest']['phone']['idOperator']?>&operator=preview">Выбрать тариф</a></td>
                <td class="last"></td>
            </tr>
    <?php
        }

        if (isset($_SESSION['cart']['latest']['phone']))
        {
    ?>
            <tr>
                <td class="first"><?=stripslashes($_SESSION['cart']['latest']['phone']['number']);?></td>
                <td class="last"><?=$_SESSION['cart']['latest']['phone']['cost']?></td>
            </tr>
    <?php
        }
        else
        {
    ?>
            <tr>
                <td class="first"><a href="/index.php?p=numbers&opid=<?=$_SESSION['cart']['latest']['tariff']['idOperator']?>">Выбрать номер</a></td>
                <td class="last"></td>
            </tr>
    <?php
        }
    ?>
    </table>
    </div>
<?php

}
