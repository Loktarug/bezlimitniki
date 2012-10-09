<?php
    if ($_REQUEST['p']=='order')
    {
        include ("order.html");
    }
    if ($_REQUEST['p']=='tariffs' && $_REQUEST['operator'] == 'preview')
    {
        include ("operatorPreview.php");
    }

    if ($_REQUEST['p']=='tariffs' && isset($_REQUEST['tariff']))
    {
        include_once ('tariff.php');
        include_once ('numbers.php');
    }
    if ($_REQUEST['p']=='numbers')
    {
        include ("numbers.php");
    }
    if ($_REQUEST['p']=='partners')
    {
        include ("partners.html");
    }
    if ($_REQUEST['p']=='aboutUs')
    {
        include ("aboutus.html");
        include ("contacts.html");
    }
    if ($_REQUEST['p']=='cart')
    {
        include ('cart.php');
    }
    if ($_REQUEST['p']=='delivery')
    {
        include ('delivery.html');
    }
    if ($_REQUEST['p']=='checkout')
    {
        include ('checkout.php');
    }
    if ($_REQUEST['p']=='teletie')
    {
        include ('teletie.html');
    }
    if (!isset($_REQUEST['p']))
    {
        include('main.php');
    }

?>