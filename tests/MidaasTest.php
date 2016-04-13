<?php

use Madmanlear\Midaas;

class MidaasTest extends PHPUnit_Framework_TestCase
{

    public $midaas;

    /**
     * Make the Midaas class available for ease of use
     */
    public function __construct()
    {
        $this->midaas = new Midaas();
    }
    
    /**
     * Test things exist section
     */

    public function test_class_exists()
    {
        $this->assertInstanceOf(Midaas::class, $this->midaas);
    }

    public function test_base_url_exists()
    {
        $this->assertInternalType('string', $this->midaas->getBaseUrl());
    }

    /**
     * Test field validation section
     */

    public function test_state_is_valid_field_name()
    {
        $this->assertEquals(true, $this->midaas->validateFieldName('state'));
    }

    public function test_page_is_invalid_field_name()
    {
        $this->assertEquals(false, $this->midaas->validateFieldName('page'));
    }

    public function test_16_25_is_valid_agegroup_value()
    {
        $this->assertEquals(true, $this->midaas->validateFieldValue('agegroup', '16-25'));
    }

    public function test_32_41_is_valid_agegroup_value()
    {
        $this->assertEquals(false, $this->midaas->validateFieldValue('agegroup', '32-41'));
    }

    public function test_race_is_valid_compare_value()
    {
        $this->assertEquals(true, $this->midaas->validateFieldValue('compare', 'race'));
    }

    public function test_height_is_invalid_compare_value()
    {
        $this->assertEquals(false, $this->midaas->validateFieldValue('compare', 'height'));
    }

    public function test_asian_is_valid_race_value()
    {
        $this->assertEquals(true, $this->midaas->validateFieldValue('race', 'asian'));
    }

    public function test_nordic_is_invalid_race_value()
    {
        $this->assertEquals(false, $this->midaas->validateFieldValue('race', 'nordic'));
    }

    public function test_female_is_valid_sex_value()
    {
        $this->assertEquals(true, $this->midaas->validateFieldValue('sex', 'female'));
    }

    public function test_unknown_is_invalid_sex_value()
    {
        $this->assertEquals(false, $this->midaas->validateFieldValue('sex', 'unknown'));
    }

    public function test_GA_is_valid_state_value()
    {
        $this->assertEquals(true, $this->midaas->validateFieldValue('state', 'GA'));
    }

    public function test_Georgia_is_invalid_state_value()
    {
        $this->assertEquals(false, $this->midaas->validateFieldValue('state', 'Georgia'));
    }

    /**
     * Test requests section
     */
    public function test_summary_endpoint_throws_exception()
    {
        $this->setExpectedException(\UnexpectedValueException::class);
        $this->midaas->request('summary');
    }

    public function test_page_field_throws_exception()
    {
        $this->setExpectedException(\InvalidArgumentException::class);
        $this->midaas->request('distribution', ['page' => '1']);
    }

    public function test_valid_request_returns_object()
    {
        $result = $this->midaas->request('distribution');
        $this->assertInternalType('object', $result);
    }

    public function test_valid_request_with_json_flag_returns_json_string()
    {
        $result = $this->midaas->request('distribution', array(), true);
        $this->assertInternalType('string', $result);
    }
}
