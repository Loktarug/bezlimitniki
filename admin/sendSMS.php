<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Lamer
 * Date: 02.05.12
 * Time: 0:54
 * To change this template use File | Settings | File Templates.
 */
//error_reporting(E_ALL);

function getSignature($params, $secret)
{
    $str = '';
    ksort($params);

    foreach ($params as $k => $v) {
        if($k != 'sig') {
            $str .= $k . '=' . $v;
        }
    }

    return  md5($str .= $secret);
}

$xmlstr = '<?xml version="1.0"?>
<send type="for_all">
    <message pay="1">
        <text>1001Rabota.com: Новые вакансии и резюме на сайте</text>
        <pseudo_text>1001Rabota.com: Новые вакансии и резюме на сайте!!!</pseudo_text>
    </message>

</send>'; // ваш текст xml для рассылки

$params = array();
$params['xml'] = $xmlstr;
$params['service_id'] = 2277;
$params['no_silent'] = 1;

$sig = getSignature($params, '9b0fb95b0cf9eb7');
$params['sig'] = $sig;



$context_params = array(
    'http'=>array(
        'method' => 'POST',
        'header' => array(
            'Content-type: application/x-www-form-urlencoded'
        ),
        'content' => http_build_query($params)
    )
);


$context = stream_context_create($context_params);

//var_dump($context_params);

$count_send = file_get_contents('http://partner.neodengi.ru/subscribe/send_api_test.php', false, $context);

var_dump($count_send);

?>