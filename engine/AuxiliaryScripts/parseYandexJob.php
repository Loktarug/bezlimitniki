<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Lamer
 * Date: 05.04.12
 * Time: 1:43
 * To change this template use File | Settings | File Templates.
 */

function parseMainPage()
{
    
}

function getPage ($url)
{
    $page = file_get_contents($url);
    echo $page;
}

getPage($_REQUEST['url']);
?>
