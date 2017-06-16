#!/usr/bin/php -q
<?php
set_time_limit(0);
include 'autoload.php';
//require_once('/var/lib/phpagi/phpagi.php');
//require_once('common/Helper.php');
use Agi;
use \common\Helper;
$url = 'https://api.okdoctor.ru/v1/asterisk/before-call';
//$url = 'https://api.okdoctorff.ru/v1/asterisk/before-callddd';


//$agi = new AGI();
//$agi->answer();
//$cid = $agi->request['agi_callerid'];
$cid = '9999';
$params = [
    'phone' => $cid
];
if ($curlDescriptor = curl_init()) {
    curl_setopt($curlDescriptor, CURLOPT_URL, $url);
    curl_setopt($curlDescriptor, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlDescriptor, CURLOPT_POST, true);
    curl_setopt($curlDescriptor, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($curlDescriptor, CURLOPT_TIMEOUT, 30);
    $out = curl_exec($curlDescriptor);

    curl_close($curlDescriptor);
    $data = json_decode($out, true);
    //print_r($data);
    //echo PHP_EOL;
    $work_time = Helper::getValueArray($data, 'work_time', 0);
    $message = Helper::getValueArray($data, 'message', 'XXX');
    if ($work_time) {
        echo "Рабочее время, отправляем звонок $message в очередь callcenter";
        //$agi->exec('Queue', "callcenter, 1");
    } else {
        echo "Нерабочее время, отправляем звонок $message в интерактивное меню";
        //$agi->exec('Goto', "ivr, s, 1");
    }
    echo PHP_EOL;
}
  //$agi->exec_dial("SIP","101","5,Tt");
