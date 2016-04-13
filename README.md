# MIDAAS-PHP

[![Build Status](https://travis-ci.org/madmanlear/MIDAAS-PHP.svg?branch=master)](https://travis-ci.org/madmanlear/MIDAAS-PHP)

A PHP wrapper for the MIDAAS API

```php
require_once 'vendor/autoload.php';

$midaas = new Madmanlear\Midaas;

$fields = [
    'sex'   => 'female',
    'state' => 'GA',
];

$results = $midaas->incomeDistribution($fields, true);

print_r($results);
```

**Composer package forthcoming.**

## About MIDAAS

MIDAAS is a commerce data service offering direct access to income census data across geographies and demographics. For more information visit [https://midaas.commerce.gov/](https://midaas.commerce.gov/)

The MIDAAS API documentation is located at [https://midaas.commerce.gov/developers/#api-get-started](https://midaas.commerce.gov/developers/#api-get-started)