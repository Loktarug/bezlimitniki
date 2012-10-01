<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Lamer
 * Date: 05.08.12
 * Time: 20:02
 * To change this template use File | Settings | File Templates.
 */
include_once('../engine/dbOperations.php');

//print_r($_REQUEST);

$tariffData = array (
    'idTariff' => $_REQUEST['paramTariffId'],
    'name' => $_REQUEST['paramTariffName'],
    'idOperator' => $_REQUEST['paramTariffOperator'],
    'isDirect' => isset($_REQUEST['paramDirectTariff'])?$_REQUEST['paramDirectTariff']:0,
    'isFederal' => isset($_REQUEST['paramFederalTariff'])?$_REQUEST['paramFederalTariff']:0,
    'shortDescription' => $_REQUEST['paramTariffDescription'],
    'withPhone' => 1,
    'actual' => 1,
    'rank' => 0);
$idTariff = dbEditTariff($tariffData);
$idTariff = $_REQUEST['paramTariffId'];
echo $idTariff;

foreach ($_REQUEST['editParamTariffSection'] as $idSection => $paramSection)
{
    $sectionData = array (
        'idSection' => $idSection,
        'idTariff' => $idTariff,
        'name' => $paramSection['name'],
        'priority'=> $paramSection['priority']
    );
    $resultSection = dbEditSection($sectionData);

    foreach ($_REQUEST['editParamTariffSubSection'][$idSection] as $idSubSection => $paramSubSection)
    {
        $subSectionData = array (
            'idSubSection' => $idSubSection,
            'idSection' => $idSection,
            'name' => $paramSubSection['name'],
            'priority'=> $paramSubSection['priority']
        );
        $resultSubSection = dbEditSubSection($subSectionData);
        foreach ($_REQUEST['editParamTariffSubSection'][$idSection][$idSubSection]['value'] as $idValue => $paramFieldValue)
        {
            if (!$paramFieldValue)
                continue;
            $fieldData = array (
                'idSubSection' => $idSubSection,
                'value' => $paramFieldValue,
                'valueType' => $paramSubSection['type'],
                'valueOrder' => $idValue,
                'priority' => $paramSubSection['priority'],
                'printAsMain' => isset($paramSubSection['printAsMain'])?$paramSubSection['printAsMain']:0,
                'classField' => $paramSubSection['classField']
            );
            dbEditField($fieldData);
        }

    }

    foreach ($_REQUEST['addParamTariffSubSection'][$idSection] as $idSubSection => $paramSubSection)
    {
        $subSectionData = array (
            'idSection' => $idSection,
            'name' => $paramSubSection['name'],
            'priority'=> $paramSubSection['priority']
        );
        $idDBSubSection = dbAddSubSection($subSectionData);
        foreach ($_REQUEST['addParamTariffSubSection'][$idSection][$idSubSection]['value'] as $idValue => $paramFieldValue)
        {
            if (!$paramFieldValue)
                continue;
            $fieldData = array (
                'idSubSection' => $idDBSubSection,
                'value' => $paramFieldValue,
                'valueType' => $paramSubSection['type'],
                'valueOrder' => $idValue,
                'priority' => $paramSubSection['priority'],
                'printAsMain' => isset($paramSubSection['printAsMain'])?$paramSubSection['printAsMain']:0,
                'classField' => $paramSubSection['classField']
            );
            dbAddField($fieldData);
        }

    }
}

print_r ($_REQUEST['addParamTariffSection']);
foreach ($_REQUEST['addParamTariffSection'] as $idSection => $paramSection)
{
    $sectionData = array (
        'idTariff' => $idTariff,
        'name' => $paramSection['name'],
        'priority'=> $paramSection['priority']
    );
    $idDBSection = dbAddSection($sectionData);

    foreach ($_REQUEST['addParamTariffSubSection'][$idSection] as $idSubSection => $paramSubSection)
    {
        $subSectionData = array (
            'idSection' => $idDBSection,
            'name' => $paramSubSection['name'],
            'priority'=> $paramSubSection['priority']
        );
        $idDBSubSection = dbAddSubSection($subSectionData);
        foreach ($_REQUEST['addParamTariffSubSection'][$idSection][$idSubSection]['value'] as $idValue => $paramFieldValue)
        {
            if (!$paramFieldValue)
                continue;
            $fieldData = array (
                'idSubSection' => $idDBSubSection,
                'value' => $paramFieldValue,
                'valueType' => $paramSubSection['type'],
                'valueOrder' => $idValue,
                'priority' => $paramSubSection['priority'],
                'printAsMain' => isset($paramSubSection['printAsMain'])?$paramSubSection['printAsMain']:0,
                'classField' => $paramSubSection['classField']
            );
            dbAddField($fieldData);
        }

    }
}