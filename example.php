<?php

require_once 'vendor/autoload.php';

$midaas = new Madmanlear\Midaas;

$fields = [
    'sex'   => 'female',
    'state' => 'GA',
];

$results = $midaas->incomeDistribution($fields, true);

print_r($results);
