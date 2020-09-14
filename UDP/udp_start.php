<?php
use Workerman\Worker;
require_once __DIR__ .'/../Workerman-master/Autoloader.php';

$con_buffer= array();
$udp_worker = new Worker('udp://0.0.0.0:5001');

$udp_worker->onMessage = function($connection, $data)
{
    //var_dump($data);
    $temp=json_decode($data);
    if($temp->'form' !=null)
    {
    	echo $temp->'form';
    }
    
    if($data=='["ping"]')
    {
    	$connection->send('["pong"]');
    }
    else
    {
    	$connection->send('["ok"]');

    }
    
};
// 运行worker
Worker::runAll();

?>