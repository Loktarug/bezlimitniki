<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Lamer
 * Date: 01.08.12
 * Time: 1:25
 * To change this template use File | Settings | File Templates.
 */

include_once ("../engine/dbOperations.php");

$tariffInfo = dbGetTariffInfo($_REQUEST['id']);

$fields = dbGetTariffFields($tariffInfo['id']);

echo json_encode(array('tariff'=> $tariffInfo, 'fields' => $fields));