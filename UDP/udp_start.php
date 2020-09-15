<?php
use Workerman\Worker;
require_once __DIR__ .'/../Workerman-master/Autoloader.php';


$udp_worker = new Worker('udp://0.0.0.0:5000');

$udp_worker->onMessage = function($connection, $data)
{
	static $con_buffer= array();
    //var_dump($data);
    $temp=json_decode($data,true);
    var_dump($temp);
    var_dump($con_buffer);
    if($temp['from'] !=null)
    {
    	$con_buffer[$temp['from']]=$connection ;
    }
    if($con_buffer[$temp['to']] !=null)
    {
    	$con_buffer[$temp['to']]->send($data);
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