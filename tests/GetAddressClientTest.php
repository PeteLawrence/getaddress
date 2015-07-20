<?php

require 'vendor/autoload.php';

class GetAddressClientTest extends PHPUnit_Framework_TestCase
{

    /**
     * Tests that attempting to instantiate GetAddressClient with an empty apiKey throws an error
     *
     * @expectedException        Exception
     * @expectedExceptionMessage No apiKey provided
     */
    public function testWithoutApikey()
    {
        $client = new \petelawrence\getaddress\GetAddressClient('');
    }


    /**
     * Tests the lookup function with an invalid apiKey
     *
     * @expectedException        \GuzzleHttp\Exception\ClientException
     * @expectedExceptionMessage Client error: 401
     */
    public function testLookupWithInvalidApikey()
    {
        $client = new \petelawrence\getaddress\GetAddressClient('fooo');
        $client->lookup('NR10 4JJ');
    }


    public function testParseResponse()
    {
        $client = new \petelawrence\getaddress\GetAddressClient('fooo');
        $response = $this->getSampleResponse();

        $result = $client->parseResponse($response);

        $this->checkResultObject($result);
    }

    /**
     * Tests the lookup function with just a postcode
     *
     * @depejnds testParseResponse
     */
    public function testLookup()
    {
        $apiKey = getenv('GETADDRESSKEY');
        if (!$apiKey) {
            $this->markTestIncomplete('No api key has been set, so unable to test against getaddress.io');
            return;
        }
        $client = new \petelawrence\getaddress\GetAddressClient($apiKey);

        $result = $client->lookup('NR10 4JJ');

        $this->checkResultObject($result);
    }

    /**
     * Tests the lookup function with a postcode and house name
     *
     * @depejnds testParseResponse
     */
    public function testLookupWithHouseName()
    {
        $apiKey = getenv('GETADDRESSKEY');
        if (!$apiKey) {
            $this->markTestIncomplete('No api key has been set, so unable to test against getaddress.io');
            return;
        }
        $client = new \petelawrence\getaddress\GetAddressClient($apiKey);

        $result = $client->lookup('NR10 4JJ', 'Bank');

        $this->assertEquals(1, sizeof($result->getAddresses()));

        //Check that the correct property was returned
        $address0 = $result->getAddresses()[0];
        $this->assertEquals('Bank House', $address0->getAddr1());
    }



    private function getSampleResponse()
    {
        //Example JSON for a lookup of 'NR10 4JJ'
        return '{"Latitude":52.76197,"Longitude":1.109534,"Addresses":["7 Market Place, , , , Reepham, Norwich, Norfolk","Bank House, Market Place, , , Reepham, Norwich, Norfolk","Bircham Centre, Market Place, , , Reepham, Norwich, Norfolk","Bonhams Auctioneers & Valuers, Market Place, , , Reepham, Norwich, Norfolk","Breese House, Market Place, , , Reepham, Norwich, Norfolk","Browns the Butchers, Sun House, Market Place, , Reepham, Norwich, Norfolk","Butler Castell, Market Place, , , Reepham, Norwich, Norfolk","Carlton House, Market Place, , , Reepham, Norwich, Norfolk","Diannes Pantry, 8 Market Place, , , Reepham, Norwich, Norfolk","Finchley Cottage, Market Place, , , Reepham, Norwich, Norfolk","Flat, 8 Market Place, , , Reepham, Norwich, Norfolk","Flat, The Chimes, Market Place, , Reepham, Norwich, Norfolk","Flat 1, Sun House, Market Place, , Reepham, Norwich, Norfolk","Flat 2, Sun House, Market Place, , Reepham, Norwich, Norfolk","Flat 3, Sun House, Market Place, , Reepham, Norwich, Norfolk","Flat 4, Sun House, Market Place, , Reepham, Norwich, Norfolk","Flat 5, Sun House, Market Place, , Reepham, Norwich, Norfolk","H S B C, Market Place, , , Reepham, Norwich, Norfolk","Hewkes House, Market Place, , , Reepham, Norwich, Norfolk","Hideaway Cottage, Market Place, , , Reepham, Norwich, Norfolk","Ivy House, Market Place, , , Reepham, Norwich, Norfolk","Kings Arms, Market Place, , , Reepham, Norwich, Norfolk","Melton House, Market Place, , , Reepham, Norwich, Norfolk","Middle Flat, Iona, Market Place, , Reepham, Norwich, Norfolk","Old Telephone Exchange, Market Place, , , Reepham, Norwich, Norfolk","One Stop, Reepham Library, Market Place, , Reepham, Norwich, Norfolk","Queen Cottage, Market Place, , , Reepham, Norwich, Norfolk","Quidsin, St. Johns Alley, Market Place, , Reepham, Norwich, Norfolk","Reepham Beauty Therapy, Market Place, , , Reepham, Norwich, Norfolk","Riches House, Market Place, , , Reepham, Norwich, Norfolk","Robertsons, Market Place, , , Reepham, Norwich, Norfolk","St. Johns Alley, Market Place, , , Reepham, Norwich, Norfolk","St. Michaels House, Market Place, , , Reepham, Norwich, Norfolk","The Chimes, Market Place, , , Reepham, Norwich, Norfolk","The Dial House, Market Place, , , Reepham, Norwich, Norfolk","The Old Bakery, Market Place, , , Reepham, Norwich, Norfolk","Top Flat, Iona, Market Place, , Reepham, Norwich, Norfolk","Tops Group, Market Place, , , Reepham, Norwich, Norfolk","Tops Office, Market Place, , , Reepham, Norwich, Norfolk","Very Nice Things, Market Place, , , Reepham, Norwich, Norfolk"]}';
    }

    private function checkResultObject($result)
    {
        $this->assertInstanceOf('\petelawrence\getaddress\GetAddressResponse', $result);
        $this->assertEquals('52.76197', $result->getLatitude());
        $this->assertEquals('1.109534', $result->getLongitude());
        $this->assertTrue(is_array($result->getAddresses()));

        //Check that the address fields have been correctly set
        $address0 = $result->getAddresses()[0];
        $this->assertEquals('7 Market Place', $address0->getAddr1());
        $this->assertEquals('', $address0->getAddr2());
        $this->assertEquals('', $address0->getAddr3());
        $this->assertEquals('', $address0->getAddr4());
        $this->assertEquals('Reepham', $address0->getTown());
        $this->assertEquals('Norwich', $address0->getPostalTown());
        $this->assertEquals('Norfolk', $address0->getCounty());
    }

}