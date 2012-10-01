<?php

//error_reporting(E_ALL);

include_once ('../engine/dbOperations.php');

function array_utf8_encode_recursive($dat)
{ if (is_string($dat)) {
    return mb_convert_encoding($dat, 'utf8', 'cp1251');
}
    if (is_object($dat)) {
        $ovs = get_object_vars($dat);
        $new=$dat;
        foreach ($ovs as $k =>$v)    {
            $new->$k=array_utf8_encode_recursive($new->$k);
        }
        return $new;
    }

    if (!is_array($dat)) return $dat;
    $ret = array();
    foreach($dat as $i=>$d) $ret[$i] = array_utf8_encode_recursive($d);
    return $ret;
}
function array_utf8_decode_recursive($dat)
{ if (is_string($dat)) {
    return utf8_decode($dat);
}
    if (is_object($dat)) {
        $ovs = get_object_vars($dat);
        $new =$dat;
        foreach ($ovs as $k =>$v)    {
            $new->$k=array_utf8_decode_recursive($new->$k);
        }
        return $new;
    }

    if (!is_array($dat)) return $dat;
    $ret = array();
    foreach($dat as $i=>$d) $ret[$i] = array_utf8_decode_recursive($d);
    return $ret;
}

$results = adminGetTariff($_REQUEST['idTariff']);
//print_r ($results);
$results = array_utf8_encode_recursive($results);
//print_r ($results);

print_r (json_encode($results));
//print_r ($results);

?>

