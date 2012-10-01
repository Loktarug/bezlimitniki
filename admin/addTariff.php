<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Lamer
 * Date: 29.07.12
 * Time: 0:34
 * To change this template use File | Settings | File Templates.
 */


include_once('../engine/dbOperations.php');

print_r($_REQUEST);
//die;

$tariffData = array ('name' => $_REQUEST['paramTariffName'],
                        'idOperator' => $_REQUEST['paramTariffOperator'],
                        'isDirect' => isset($_REQUEST['paramDirectTariff'])?$_REQUEST['paramDirectTariff']:0,
                        'isFederal' => isset($_REQUEST['paramFederalTariff'])?$_REQUEST['paramFederalTariff']:0,
                        'shortDescription' => $_REQUEST['paramTariffDescription'],
                        'withPhone' => 1,
                        'actual' => 1,
                        'rank' => 0);
$idTariff = dbAddTariff($tariffData);
echo $idTariff;

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