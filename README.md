# MIDAAS-PHP

[![Build Status](https://travis-ci.org/madmanlear/MIDAAS-PHP.svg?branch=master)](https://travis-ci.org/madmanlear/MIDAAS-PHP)

A PHP wrapper for the MIDAAS API. Validates all query fields before making a request and will return either a PHP Object or a JSON string.

## Installation

`composer require madmanlear/midaas`

## Example Use

```php
require_once 'vendor/autoload.php';

$midaas = new Madmanlear\Midaas;

$fields = [
    'sex'   => 'female',
    'state' => 'GA',
];

//Return an Object
$distrubition_results = $midaas->incomeDistribution($fields);

//Return JSON
$quantile_results = $midaas->incomeQuantile($fields, true);

print_r($distrubition_results);
print_r($quantile_results);
```

## About MIDAAS

MIDAAS is a commerce data service offering direct access to income census data across geographies and demographics. For more information visit [https://midaas.commerce.gov/](https://midaas.commerce.gov/)

The MIDAAS API documentation is located at [https://midaas.commerce.gov/developers/#api-get-started](https://midaas.commerce.gov/developers/#api-get-started)