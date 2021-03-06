<?php



if (isset($_GET['buy']) && in_array($_GET['buy'], $GLOBALS['buyTypes']))
{
    $buyType = $_GET['buy'];
    switch ($buyType)
    {
        case 'phone':
            if (addPhone($_GET['number']))
                $GLOBALS['showModalWindow'] = 'addNewPhone';
            break;
        case 'tariff':
            if(addTariff($_GET['tariff']))
                $GLOBALS['showModalWindow'] = 'addNewTariff';
            break;
        default:
            echo '';
    }

    $summary = 0;
    foreach ($_SESSION['cart']['packes'] as $packNumber => $pack)
    {
        if (isset($pack['tariff']))
        {
            $summary += $pack['tariff'][2];
            $summary += 500;
        }

        if (isset($pack['phone']))
        {
            $summary += $pack['phone']['cost'];
        }
    }
    $_SESSION['cart']['summary'] = $summary;
}

if (isset($_GET['remove']) &&  in_array($_GET['remove'], $GLOBALS['removeTypes']))
{
    $removeType = $_GET['remove'];
    switch ($removeType)
    {
        case 'tariff':
            removeTariff ($_GET['pack'], $_GET['tariff']);
            break;
        case 'phone':
            removePhone ($_GET['pack'], $_GET['number']);
            break;
        default:
            echo '';
    }

    $summary = 0;
    foreach ($_SESSION['cart']['packes'] as $packNumber => $pack)
    {
        if (isset($pack['tariff']))
        {
            $summary += $pack['tariff'][2];
            $summary += 500;
        }

        if (isset($pack['phone']))
        {
            $summary += $pack['phone']['cost'];
        }
    }
    $_SESSION['cart']['summary'] = $summary;

}
if (isset($_POST['checkoutForm']))
{
    $_SESSION['cart']['packes'] = array();
    $_SESSION['cart']['phoneNumbers'] = array();
    $_SESSION['cart']['quantity'] = 0;
}