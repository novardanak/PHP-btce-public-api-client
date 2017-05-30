<?php

require_once('BTCeApiClient.php');
$class = new BTCePublicApiClient('ticker',array('btc_usd','ltc_usd','eth_usd'));
$data = $class->send();
var_dump($data);die;

?>
