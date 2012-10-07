<?php
//error_reporting(E_ALL);
//error_reporting(0);

$dbHost = 'ibolit.mysql';
$dbName = 'ibolit_bezlimitniki';
$dbUser = 'ibolit_mysql';
$dbPass = '2d7yzjjz';


/*mysql_query("SET NAMES 'utf8'");
mysql_query("SET collation_connection = 'UTF-8_general_ci'");
mysql_query("SET collation_server = 'UTF-8_general_ci'");
mysql_query("SET character_set_client = 'UTF-8'");
mysql_query("SET character_set_connection = 'UTF-8'");
mysql_query("SET character_set_results = 'UTF-8'");
mysql_query("SET character_set_server = 'UTF-8'");*/


function errorMessageHandler ($e)
{
    echo $e->getMessage();
}
//connect to DB
try {
    # MySQL через PDO_MYSQL
    $DBH = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

    $DBH->exec("SET NAMES 'utf8'");
    $DBH->exec("SET collation_connection = 'utf8_general_ci'");
    $DBH->exec("SET collation_server = 'utf8_general_ci'");
    $DBH->exec("SET character_set_client = 'utf8'");
    $DBH->exec("SET character_set_connection = 'utf8'");
    $DBH->exec("SET character_set_results = 'utf8'");
    $DBH->exec("SET character_set_server = 'utf8'");
}
catch(PDOException $e) {
    errorMessageHandler($e);
}

function dbAddTariff($structure)
{
    global $DBH;
    $idTariff = 0;
    try {
        $STH = $DBH->prepare("INSERT INTO headers (idOperator, name, isDirect, isFederal, shortDescription, withPhone, actual, rank) VALUES (:idOperator, :name, :isDirect, :isFederal, :shortDescription, :withPhone, :actual, :rank)");
        $STH->execute($structure);
        $idTariff = $DBH->lastInsertId();
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $idTariff;
}

function dbAddField($structure)
{
    global $DBH;
    $idField = 0;
    try {
        $STH = $DBH->prepare("INSERT INTO fields (idSubSection, value, valueType, valueOrder, priority, printAsMain, classField) VALUES (:idSubSection, :value, :valueType, :valueOrder, :priority, :printAsMain, :classField)");
        $STH->execute($structure);
        $idField = $DBH->lastInsertId();
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $idField;
}

function dbAddSection($structure)
{
    global $DBH;
    $idSection = 0;
    try {
        $STH = $DBH->prepare("INSERT INTO sections (idTariff, name, priority) VALUES (:idTariff, :name, :priority)");
        $STH->execute($structure);
        $idSection = $DBH->lastInsertId();
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $idSection;
}

function dbAddSubSection($structure)
{
    global $DBH;
    $idSubSection = 0;
    try {
        $STH = $DBH->prepare("INSERT INTO subSections (idSection, name, priority) VALUES (:idSection, :name, :priority)");
        $STH->execute($structure);
        $idSubSection = $DBH->lastInsertId();
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $idSubSection;
}

function dbEditTariff($structure)
{
    global $DBH;
    try {
        $STH = $DBH->prepare("UPDATE headers SET idOperator = :idOperator, name = :name, isDirect = :isDirect, isFederal = :isFederal, shortDescription = :shortDescription, withPhone = :withPhone, actual = :actual, rank = :rank WHERE id = :idTariff");
        $STH->execute($structure);
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return true;
}

function dbEditField($structure)
{
    global $DBH;
    try {
        $STH = $DBH->prepare("UPDATE fields SET value = :value, valueType = :valueType, priority = :priority, printAsMain = :printAsMain, classField = :classField WHERE idSubSection = :idSubSection AND valueOrder = :valueOrder");
        echo $DBH->lastInsertId();
        $STH->execute($structure);
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return true;
}

function dbEditSection($structure)
{
    global $DBH;
    try {
        $STH = $DBH->prepare("UPDATE sections SET idTariff = :idTariff, name = :name, priority = :priority WHERE id = :idSection");
        $STH->execute($structure);
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return true;
}

function dbEditSubSection($structure)
{
    global $DBH;
    try {
        $STH = $DBH->prepare("UPDATE subSections SET idSection = :idSection, name = :name, priority = :priority WHERE id = :idSubSection");
        $STH->execute($structure);
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return true;
}

function dbGetPhoneByNumberInt($structure)
{
    global $DBH;
    $phone = array ();
        try {
            $STH = $DBH->prepare("SELECT idOperator, number, numberint, cost, numberType FROM phones WHERE numberint = :numberint");
            $STH->execute($structure);
            while($row = $STH->fetch()) {
                $phone['idOperator'] = $row['idOperator'];
                $phone['number'] = $row['number'];
                $phone['numberint'] = $row['numberint'];
                $phone['cost'] = $row['cost'];
                $phone['numberType'] = $row['numberType'];
            }
        }
        catch(PDOException $e) {
            errorMessageHandler($e);
        }
        return $phone;
}

function dbGetPhones($structure)
{
    global $DBH;
    $phones = array ();
    try {
        $STH = $DBH->prepare("SELECT idOperator, number, numberint, cost, numberType FROM phones WHERE numberType = :numberType ORDER BY cost ASC LIMIT 0,50");
        $STH->execute($structure);
        while($row = $STH->fetch()) {
            $phones[$row['numberint']]['idOperator'] = $row['idOperator'];
            $phones[$row['numberint']]['number'] = $row['number'];
            $phones[$row['numberint']]['cost'] = $row['cost'];
            $phones[$row['numberint']]['numberType'] = $row['numberType'];
        }
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $phones;
}

function dbGetPhonesByOperator($structure)
{
    global $DBH;
    $phones = array ();
    try {
        $STH = $DBH->prepare("SELECT idOperator, number, numberint, cost, numberType FROM phones WHERE idOperator = :idOperator AND numberType = :numberType ORDER BY cost ASC LIMIT 0,50");
        $STH->execute($structure);
        while($row = $STH->fetch()) {
            $phones[$row['numberint']]['idOperator'] = $row['idOperator'];
            $phones[$row['numberint']]['number'] = $row['number'];
            $phones[$row['numberint']]['numberint'] = $row['numberint'];
            $phones[$row['numberint']]['cost'] = $row['cost'];
            $phones[$row['numberint']]['numberType'] = $row['numberType'];
        }
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $phones;
}

function dbGetTariffShort()
{
    global $DBH;
    $tariffs = array ();
    try {
        $STH = $DBH->prepare("SELECT id, name FROM headers WHERE 1");
        $STH->execute();
        while($row = $STH->fetch()) {
            $tariffs[$row['id']] = $row['name'];
        }
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $tariffs;
}

function dbGetTariffInfo($id)
{
    global $DBH;
    $tariff = array ();
    try {
        $STH = $DBH->prepare("SELECT * FROM headers WHERE id = :id");
        $STH->execute(array('id' => $id));
        $tariff = $STH->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $tariff;
}

function dbGetTariffsInfo()
{
    global $DBH;
    $fields = array ();
    try {
        $STH = $DBH->prepare("SELECT headers.id, headers.shortDescription, headers.idOperator, headers.name, headers.idOperator FROM headers WHERE (headers.isDirect = 1 OR headers.isFederal = 1) AND headers.actual = 1");
        $STH->execute();
        $tariff = $STH->fetch(PDO::FETCH_ASSOC);
        while($row = $STH->fetch(PDO::FETCH_NAMED)) {
            $fields[$row['id']]['name'] = $row['name'];
            $fields[$row['id']]['description'] = $row['shortDescription'];
            $fields[$row['id']]['idOperator'] = $row['idOperator'];
        }
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $fields;
}

function dbGetTariffsInfoByType($structure)
{
    global $DBH;
    $fields = array ();
    try {
        $STH = $DBH->prepare("SELECT headers.id, headers.shortDescription, headers.idOperator, headers.name, headers.idOperator FROM headers WHERE (headers.isDirect = :isDirect AND headers.isFederal = :isFederal) AND headers.actual = 1");
        $STH->execute($structure);
        $tariff = $STH->fetch(PDO::FETCH_ASSOC);
        while($row = $STH->fetch(PDO::FETCH_NAMED)) {
            $fields[$row['id']]['name'] = $row['name'];
            $fields[$row['id']]['description'] = $row['shortDescription'];
            $fields[$row['id']]['idOperator'] = $row['idOperator'];
        }
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $fields;
}

function dbGetTariffFields($idTariff)
{
    global $DBH;
    $fields = array ();
    try {
        $STH = $DBH->prepare('SELECT sections.id, sections.name, sections.priority, subSections.id, subSections.name, subSections.priority, fields.id, fields.priority, fields.value, fields.valueType, fields.valueOrder, fields.printAsMain, fields.classField FROM sections LEFT JOIN subSections ON sections.id = subSections.idSection LEFT JOIN fields ON subSections.id = fields.idSubSection WHERE idTariff = :idTariff');
        $STH->execute(array('idTariff' => $idTariff));
        while($row = $STH->fetch(PDO::FETCH_NAMED)) {
            array_push($fields, $row);
        }
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    //print_r ($fields);
    return $fields;
}

function dbSelectAllTariffs ($idOperator)
{
    global $DBH;
    try {
        $STH = $DBH->prepare("SELECT * FROM headers WHERE 1");
        $STH->execute();
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $STH->fetch()) {
            print_r ($row);
        }
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
}

function dbGetTariffCommonInfo ($structure)
{
    $tariff = array ();
    global $DBH;
    try {
        $sql = 'SELECT headers.id, headers.idOperator, headers.name, headers.isDirect, headers.isFederal, fields.value, fields.classField FROM headers LEFT JOIN sections ON headers.id = sections.idTariff LEFT JOIN subSections ON sections.id = subSections.idSection LEFT JOIN fields ON subSections.id = fields.idSubSection WHERE headers.id = :idTariff AND fields.classField > 0';

        $STH = $DBH->prepare($sql);
        $STH->execute($structure);
        while($row = $STH->fetch(PDO::FETCH_NAMED)) {
            $tariff['id'] = $row['id'];
            $tariff['name'] = $row['name'];
            $tariff['description'] = $row['shortDescription'];
            $tariff['idOperator'] = $row['idOperator'];
            $tariff['isDirect'] = $row['isDirect'];
            $tariff['isFederal'] = $row['isFederal'];
            $tariff[$row['classField']] = $row['value'];
        }
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $tariff;

}

function dbGetTariffsCommonInfo ($type)
{
    $types = array ('federal', 'direct');
    $fields = array ();
    global $DBH;
    if (in_array($type, $types))
    {
        try {
            $sql = '';
            switch (array_search($type, $types))
            {
                case 0:
                    $sql = 'SELECT headers.id, headers.shortDescription, headers.idOperator, headers.name, headers.idOperator, fields.value, fields.classField FROM headers LEFT JOIN sections ON headers.id = sections.idTariff LEFT JOIN subSections ON sections.id = subSections.idSection LEFT JOIN fields ON subSections.id = fields.idSubSection WHERE headers.showAsMain = 1 AND headers.isFederal = 1 AND fields.classField > 0';
                    break;
                case 1:
                    $sql = 'SELECT headers.id, headers.shortDescription, headers.idOperator, headers.name, headers.idOperator, fields.value, fields.classField FROM headers LEFT JOIN sections ON headers.id = sections.idTariff LEFT JOIN subSections ON sections.id = subSections.idSection LEFT JOIN fields ON subSections.id = fields.idSubSection WHERE headers.showAsMain = 1 AND headers.isDirect = 1 AND fields.classField > 0';
                    break;
            }
            $STH = $DBH->prepare($sql);
            $STH->execute();
            while($row = $STH->fetch(PDO::FETCH_NAMED)) {
                $fields[$row['id']]['name'] = $row['name'];
                $fields[$row['id']]['description'] = $row['shortDescription'];
                $fields[$row['id']]['idOperator'] = $row['idOperator'];
                $fields[$row['id']][$row['classField']]['value'] = $row['value'];
            }
        }
        catch(PDOException $e) {
            errorMessageHandler($e);
        }
    }
    return $fields;

}

function dbGetTariff($structure)
{
    global $DBH;
    $fields = array ();
    try {
        $STH = $DBH->prepare('SELECT headers.id, headers.name, headers.idOperator, headers.shortDescription, headers.isDirect, headers.isFederal, sections.id, sections.name, sections.priority, subSections.id, subSections.name, subSections.priority, fields.id, fields.priority, fields.value, fields.valueType, fields.valueOrder, fields.printAsMain, fields.classField FROM headers LEFT JOIN sections ON headers.id = sections.idTariff LEFT JOIN subSections ON sections.id = subSections.idSection LEFT JOIN fields ON subSections.id = fields.idSubSection WHERE idTariff = :idTariff');
        $STH->execute($structure);
        while($row = $STH->fetch(PDO::FETCH_NUM)) {
            $fields['idTariff'] = $row[0];
            $fields['name'] = $row[1];
            $fields['idOperator'] = $row[2];
            $fields['descriptions'] = $row[3];
            $fields['isDirect'] = $row[4];
            $fields['isFederal'] = $row[5];
            $fields['sections'][$row[6]]['name'] = $row[7];
            $fields['sections'][$row[6]]['priority'] = $row[8];
            $fields['sections'][$row[6]]['subSections'][$row[9]]['name'] = $row[10];
            $fields['sections'][$row[6]]['subSections'][$row[9]]['priority'] = $row[11];
            $fields['sections'][$row[6]]['subSections'][$row[9]]['fields'][$row[12]]['priority'] = $row[13];
            $fields['sections'][$row[6]]['subSections'][$row[9]]['fields'][$row[12]]['value'] = $row[14];
            $fields['sections'][$row[6]]['subSections'][$row[9]]['fields'][$row[12]]['valueType'] = $row[15];
            $fields['sections'][$row[6]]['subSections'][$row[9]]['fields'][$row[12]]['valueOrder'] = $row[16];
            $fields['sections'][$row[6]]['subSections'][$row[9]]['fields'][$row[12]]['printAsMain'] = $row[17];
            $fields['sections'][$row[6]]['subSections'][$row[9]]['fields'][$row[12]]['classField'] = $row[18];

        }
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    //print_r ($fields);
    return $fields;
}








//----------------------------- ADMIN FUNCTIONS ------------------------------------



function adminGetTariff ($id)
{
    $query = "SELECT * FROM `headers` LEFT JOIN `sections` ON `headers`.`id` = `sections`.`idTariff` LEFT JOIN `subSections` ON `sections`.`id` = `subSections`.`idSection` LEFT JOIN `fields` ON `subSections`.`id` = `fields`.`idSubSection` WHERE `headers`.id = '".$id."' ORDER BY `sections`.`priority` DESC";
    //echo $query;
    $result = mysql_query($query);
    $resultQuantity = mysql_num_rows($result);
    $tariff = array();
    $tariff['name'] = mysql_result($result, 0, 'headers.name');
    $tariff['isDirect'] = mysql_result($result, 0, 'headers.isDirect');
    $tariff['isFederal'] = mysql_result($result, 0, 'headers.isFederal');
    $tariff['shortDescription'] = mysql_result($result, 0, 'headers.shortDescription');
    $tariff['withPhone'] = mysql_result($result, 0, 'headers.withPhone');
    $tariff['actual'] = mysql_result($result, 0, 'headers.actual');
    $tariff['rank'] = mysql_result($result, 0, 'headers.rank');
    for ($i=0; $i<$resultQuantity; $i++)
    {
        $idSection = mysql_result($result, $i, 'sections.id');
        $tariff['sections'][$idSection]['name'] = mysql_result($result, $i, 'sections.name');
        $tariff['sections'][$idSection]['priority'] = mysql_result($result, $i, 'sections.priority');

        $idSubSection = mysql_result($result, $i, 'subSections.id');
        $tariff['sections'][$idSection]['subSections'][$idSubSection]['name'] = mysql_result($result, $i, 'subSections.name');
        $tariff['sections'][$idSection]['subSections'][$idSubSection]['priority'] = mysql_result($result, $i, 'subSections.priority');

        $idValue = mysql_result($result, $i, 'fields.id');
        $tariff['sections'][$idSection]['subSections'][$idSubSection]['values'][$idValue]['value'] = mysql_result($result, $i, 'fields.value');
        $tariff['sections'][$idSection]['subSections'][$idSubSection]['values']['valueType'] = mysql_result($result, $i, 'fields.valueType');
    }
    //print_r ($tariff);
    return $tariff;
}


//----------------------------- Auxiliary FUNCTIONS ------------------------------------


function dbAddPhone($structure)
{
    global $DBH;
    $idSection = 0;
    try {
        $STH = $DBH->prepare("INSERT INTO phones (idOperator, number, numberint, cost, numberType, resurected, agency, uid, tariffName, toMegafon, fix) VALUES (:idOperator, :number, :numberint, :cost, :numberType, :resurected, :agency, :uid, :tariffName, :toMegafon, :fix)");
        $STH->execute($structure);
        $idSection = $DBH->lastInsertId();
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $idSection;
}

function dbRemoveAllPhones()
{
    global $DBH;
    $idSection = 0;
    try {
        $STH = $DBH->prepare("TRUNCATE TABLE phones");
        $STH->execute();
    }
    catch(PDOException $e) {
        errorMessageHandler($e);
    }
    return $idSection;
}