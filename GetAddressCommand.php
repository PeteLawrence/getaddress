<?php

require 'vendor/autoload.php';

$key = 'Pil2it2vnEiFRFFBAyDXBw2242';
$client = new \petelawrence\getaddress\GetAddressClient($key);
$postcode = $argv[1];

$result = $client->lookup($postcode);
foreach ($result->getAddresses() as $address) {
    echo $address->toCsv() . PHP_EOL;
}
