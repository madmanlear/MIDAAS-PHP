<?php

namespace Madmanlear;

use \GuzzleHttp\Client;

class Midaas
{

    private $base_url = 'https://brbimhg0w9.execute-api.us-west-2.amazonaws.com/dev/income/';

    private $valid_fields = [
        'agegroup',
        'compare',
        'race',
        'sex',
        'state',
    ];

    private $valid_endpoints = [
        'distribution',
        'quantile',
    ];

    public function getBaseUrl()
    {
        return $this->base_url;
    }

    public function incomeQuantile($options, $json = false)
    {
        return $this->request('quantile', $options, $json);
    }

    public function incomeDistribution($options, $json = false)
    {
        return $this->request('distribution', $options, $json);
    }

    public function request($endpoint, $options = array(), $json = false)
    {
        if (!in_array($endpoint, $this->valid_endpoints)) {
            throw new \UnexpectedValueException("This endpoint does not exist");
        }

        if(!$this->validateFields($options)) {
            throw new \InvalidArgumentException("Error Processing Request");
        }

        $client = new Client();

        //Letting Guzzle throw its own exceptions
        //so this function can be wrapped in a try/catch
        //and the only returned response will be a successful one
        $request = $client->request('GET', $this->getBaseUrl() . $endpoint, [
            'http_errors' => true,
            'query' => $options
        ]);

        $body = $request->getBody();
        $contents = $body->getContents();

        if ($json === true) {
            return $contents;
        }

        return json_decode($contents);
    }

    public function getAgegroupList()
    {
        return [
            "0-15",
            "16-25",
            "26-35",
            "36-45",
            "46-55",
            "55-65",
            "65+",
        ];
    }

    public function getCompareList()
    {
        return [
            "agegroup",
            "race",
            "sex",
            "state",
        ];
    }

    public function getRaceList()
    {
        return [
            "african american",
            "asian",
            "hispanic",
            "white",
        ];
    }

    public function getSexList()
    {
        return [
            "female",
            "male",
        ];
    }

    public function getStateList()
    {
        return [
            "AL",
            "AK",
            "AR",
            "AR",
            "CA",
            "CO",
            "CT",
            "DE",
            "DC",
            "FL",
            "GA",
            "HI",
            "ID",
            "IL",
            "IN",
            "IA",
            "KS",
            "KY",
            "LA",
            "ME",
            "MD",
            "MA",
            "MI",
            "MN",
            "MS",
            "MO",
            "MT",
            "NE",
            "NV",
            "NH",
            "NJ",
            "NM",
            "NY",
            "NC",
            "ND",
            "OH",
            "OK",
            "OR",
            "PA",
            "RI",
            "SC",
            "SD",
            "TN",
            "TX",
            "UT",
            "VT",
            "VA",
            "WA",
            "WV",
            "WI",
            "WY"
        ];
    }

    public function validateFields($fields)
    {
        foreach ($fields as $field_name => $field_value) {
            if (!$this->validateField($field_name, $field_value)) {
                return false;
            }
        }

        return true;
    }

    public function validateField($field_name, $field_value = '')
    {
        if (!$this->validateFieldName($field_name)) {
            return false;
        }

        return $this->validateFieldValue($field_name, $field_value);
    }

    public function validateFieldName($field_name)
    {
        if (!in_array($field_name, $this->valid_fields)) {
            return false;
        }

        return true;
    }

    public function validateFieldValue($field_name, $field_value)
    {
        $method = 'get' . ucfirst($field_name) . 'List';

        if (!method_exists($this, $method)) {
            return false;
        }

        $values = $this->$method();

        if (!in_array($field_value, $values)) {
            return false;
        }

        return true;
    }
}
