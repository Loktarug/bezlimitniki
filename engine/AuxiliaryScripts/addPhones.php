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
            $phone['number']            = preg_replace("@[^0-9/-]+@i", '', $_file[0]);   //�����
            $phone['numberint']         = preg_replace("@[^0-9]+@i", '', $_file[0]);     //����� (������ �����)
            $phone['cost']              = $_file[1];                                     //����
            $phone['numberType']        = $_file[2];                                     //��� ������ (�����������/������)
            $phone['resurected']        = $_file[3];                                     //�������������� ������  (���� 1 �� ��������������)
            $phone['agency']            = $_file[4];                                     //��������� ��� ���   (���� � ���� 2 �� �� ���������)
            $phone['uid']               = $_file[5];                                     //���������� ����� ������
            $phone['tariffName']        = mb_convert_encoding ($_file[6], 'UTF-8', 'Windows-1251');      //�������� ������
            $phone['toMegafon']         = $_file[7];                                     //� ��������   (���� � ���� 0 ���, 1 �� ���)
            $phone['fix']               = $_file[8];                                     //������������� ����� (���� � ���� 1 �� �������� ������ � ���� �������)
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
            $phone['number']            = preg_replace("@[^0-9/-]+@i", '', $_file[0]);   //�����
            $phone['numberint']         = preg_replace("@[^0-9]+@i", '', $_file[0]);     //����� (������ �����)
            $phone['cost']              = $_file[1];                                     //����
            $phone['numberType']        = $_file[2];                                     //��� ������ (�����������/������)
            $phone['resurected']        = $_file[3];                                     //�������������� ������  (���� 1 �� ��������������)
            $phone['agency']            = $_file[4];                                     //��������� ��� ���   (���� � ���� 2 �� �� ���������)
            $phone['uid']               = $_file[5];                                     //���������� ����� ������
            $phone['tariffName']        = mb_convert_encoding ($_file[6], 'UTF-8', 'Windows-1251');      //�������� ������
            $phone['toMegafon']         = $_file[7];                                     //� ��������   (���� � ���� 0 ���, 1 �� ���)
            $phone['fix']               = $_file[8];                                     //������������� ����� (���� � ���� 1 �� �������� ������ � ���� �������)
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
            $phone['number']            = preg_replace("@[^0-9/-]+@i", '', $_file[0]);   //�����
            $phone['numberint']         = preg_replace("@[^0-9]+@i", '', $_file[0]);     //����� (������ �����)
            $phone['cost']              = $_file[1];                                     //����
            $phone['numberType']        = $_file[2];                                     //��� ������ (�����������/������)
            $phone['resurected']        = $_file[3];                                     //�������������� ������  (���� 1 �� ��������������)
            $phone['agency']            = $_file[4];                                     //��������� ��� ���   (���� � ���� 2 �� �� ���������)
            $phone['uid']               = $_file[5];                                     //���������� ����� ������
            $phone['tariffName']        = mb_convert_encoding ($_file[6], 'UTF-8', 'Windows-1251');      //�������� ������
            $phone['toMegafon']         = $_file[7];                                     //� ��������   (���� � ���� 0 ���, 1 �� ���)
            $phone['fix']               = $_file[8];                                     //������������� ����� (���� � ���� 1 �� �������� ������ � ���� �������)
            dbAddPhone($phone);
        }
    }
