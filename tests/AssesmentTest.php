<?php

use DatabaseTesting\Tests\Persistence\DatabaseTestCase;
class AssesmentTest extends \PHPUnit\Framework\TestCase {
    


    public function testReadCountry() {

        $record = new App\DataModel;
        $_FILES = [
            'file' => [
                'error'    => UPLOAD_ERR_OK,
                'name'     => 'country.csv',  
                'size'     => 123,
                'tmp_name' => '../test/csv/country.csv',  
                'type'     => 'text/csv'
            ]
        ];
        $result = $record->readCountry();
        $expected = [
             "type" => 'success', "message" => "Import completed."
        ];

        $this->assertEquals($expected, $result);
    }

    public function testReadCurrency()
    {

        $record = new App\DataModel;
        $_FILES = [
            'file' => [
                'error'    => UPLOAD_ERR_OK,
                'name'     => 'currencies.csv',  
                'size'     => 123,
                'tmp_name' => '../test/csv/currencies.csv',  
                'type'     => 'text/csv'
            ]
        ];
        $result = $record->readCurrency();
        $expected = [
            "type" => 'success', "message" => "Import completed."
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGetCountries()
    {
        $record = new App\DataModel;
        $result = $record->getAllCountries();

        $this->assertIsArray($result);
    }
    public function testGetCurrencies()
    {
        $record = new App\DataModel;
        $result = $record->getAllCurrencies();

        $this->assertIsArray($result);
    }

}