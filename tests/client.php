<?php
include('../src/Esock.php');

use Esock\Esock;

$ip = '91.107.153.188';
$port = 9000;

$esock = new Esock;
$client = $esock->initClient($ip, $port) or die($esock->lastError);

$esock->write($client, 'its a realy test') or die($esock->lastError);

$input = $esock->read($client) or die($esock->lastError);
echo $input;
