<?php

include_once ('../dbOperations.php');

    $pagelocation ="http://2255757.ru/numbers/numbers_1.php";

    $file = file_get_contents($pagelocation);
    $file = unserialize(base64_decode($file));

    if(is_array($file) && count($file) != 0)
    {
        dbRemoveAllPhones();
        foreach($file as $key => $_file)
        {
            $phone['idOperator']        = 1;
            $phone['number']            = preg_replace("@[^0-9/-]+@i", '', $_file[0]);   //номер
            $phone['numberint']         = preg_replace("@[^0-9]+@i", '', $_file[0]);     //номер (только цифры)
            $phone['cost']              = $_file[1];                                     //цена
            $phone['numberType']        = $_file[2];                                     //тип номера (федеральный/прямой)
            $phone['resurected']        = $_file[3];                                     //востановленные номера  (если 1 то востановленный)
            $phone['agency']            = $_file[4];                                     //агентские или нет   (если в поле 2 то не агенсткий)
            $phone['uid']               = $_file[5];                                     //уникальный номер тарифа
            $phone['tariffName']        = mb_convert_encoding ($_file[6], 'UTF-8', 'Windows-1251');      //название тарифа
            $phone['toMegafon']         = $_file[7];                                     //к Мегафону   (если в поле 0 ДАФ, 1 не ДАФ)
            $phone['fix']               = $_file[8];                                     //фиксированный тариф (если в поле 1 то продаётся только с этим тарифом)
            dbAddPhone($phone);
        }
    }

    $pagelocation ="http://2255757.ru/numbers/numbers_2.php";

    $file = file_get_contents($pagelocation);
    $file = unserialize(base64_decode($file));

    if(is_array($file) && count($file) != 0)
    {
        foreach($file as $key => $_file)
        {
            $phone['idOperator']        = 2;
            $phone['number']            = preg_replace("@[^0-9/-]+@i", '', $_file[0]);   //номер
            $phone['numberint']         = preg_replace("@[^0-9]+@i", '', $_file[0]);     //номер (только цифры)
            $phone['cost']              = $_file[1];                                     //цена
            $phone['numberType']        = $_file[2];                                     //тип номера (федеральный/прямой)
            $phone['resurected']        = $_file[3];                                     //востановленные номера  (если 1 то востановленный)
            $phone['agency']            = $_file[4];                                     //агентские или нет   (если в поле 2 то не агенсткий)
            $phone['uid']               = $_file[5];                                     //уникальный номер тарифа
            $phone['tariffName']        = mb_convert_encoding ($_file[6], 'UTF-8', 'Windows-1251');      //название тарифа
            $phone['toMegafon']         = $_file[7];                                     //к Мегафону   (если в поле 0 ДАФ, 1 не ДАФ)
            $phone['fix']               = $_file[8];                                     //фиксированный тариф (если в поле 1 то продаётся только с этим тарифом)
            dbAddPhone($phone);

        }
    }


    $pagelocation ="http://2255757.ru/numbers/numbers_3.php";

    $file = file_get_contents($pagelocation);
    $file = unserialize(base64_decode($file));

    if(is_array($file) && count($file) != 0)
    {
        foreach($file as $key => $_file)
        {
            $phone['idOperator']        = 3;
            $phone['number']            = preg_replace("@[^0-9/-]+@i", '', $_file[0]);   //номер
            $phone['numberint']         = preg_replace("@[^0-9]+@i", '', $_file[0]);     //номер (только цифры)
            $phone['cost']              = $_file[1];                                     //цена
            $phone['numberType']        = $_file[2];                                     //тип номера (федеральный/прямой)
            $phone['resurected']        = $_file[3];                                     //востановленные номера  (если 1 то востановленный)
            $phone['agency']            = $_file[4];                                     //агентские или нет   (если в поле 2 то не агенсткий)
            $phone['uid']               = $_file[5];                                     //уникальный номер тарифа
            $phone['tariffName']        = mb_convert_encoding ($_file[6], 'UTF-8', 'Windows-1251');      //название тарифа
            $phone['toMegafon']         = $_file[7];                                     //к Мегафону   (если в поле 0 ДАФ, 1 не ДАФ)
            $phone['fix']               = $_file[8];                                     //фиксированный тариф (если в поле 1 то продаётся только с этим тарифом)
            dbAddPhone($phone);
        }
    }
