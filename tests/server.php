<?php
include('../src/Esock.php');

use Esock\Esock;

$ip = '91.107.153.188';
$port = 9000;

$esock = new Esock;
$esock->initServer($ip, $port) or die($esock->lastError);


while (true) {

    $client = $esock->accept() or die($esock->lastError);


    $input = $esock->read($client) or die($esock->lastError);

    echo $input;

    $esock->write($client, 'ok') or die($esock->lastError);
    $esock->close($client) or die($esock->lastError);
}
