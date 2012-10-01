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
}

if (isset($_POST['checkoutForm']))
{
    $_SESSION['cart']['packes'] = array();
    $_SESSION['cart']['phoneNumbers'] = array();
    $_SESSION['cart']['quantity'] = 0;
}