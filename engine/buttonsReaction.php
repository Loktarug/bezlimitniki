<?php



if (isset($_GET['buy']) && in_array($_GET['buy'], $GLOBALS['buyTypes']))
{
    $buyType = $_GET['buy'];
    switch ($buyType)
    {
        case 'phone':
            addPhone($_GET['number']);
            break;
        case 'tariff':
            addTariff($_GET['tariff']);
            break;
        default:
            echo '';
    }

    $summary = 0;
    foreach ($_SESSION['cart']['packes'] as $packNumber => $pack)
    {
        if (isset($pack['tariff']))
        {
            $summary += $pack['tariff'][1];
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