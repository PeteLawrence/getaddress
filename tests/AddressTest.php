<?php

require 'vendor/autoload.php';

class AddressTest extends PHPUnit_Framework_TestCase
{
    public function testCreateAddress()
    {
        $address = new \petelawrence\getaddress\Address('Addr1', 'Addr2', 'Addr3', 'Addr4', 'Town', 'Postal Town', 'County');
        $this->assertEquals('Addr1', $address->getAddr1());
        $this->assertEquals('Addr2', $address->getAddr2());
        $this->assertEquals('Addr3', $address->getAddr3());
        $this->assertEquals('Addr4', $address->getAddr4());
        $this->assertEquals('Town', $address->getTown());
        $this->assertEquals('Postal Town', $address->getPostalTown());
        $this->assertEquals('County', $address->getCounty());
    }


    public function testGetNormalisedAddress1()
    {
        $address = new \petelawrence\getaddress\Address('Addr1', 'Addr2', 'Addr3', 'Addr4', 'Town', 'Postal Town');
        $this->assertEquals('Town', $address->getNormalisedTown());
    }


    public function testGetNormalisedAddress2()
    {
        $address = new \petelawrence\getaddress\Address('Addr1', 'Addr2', 'Addr3', 'Addr4', 'Town');
        $this->assertEquals('Town', $address->getNormalisedTown());
    }


    public function testGetNormalisedAddress3()
    {
        $address = new \petelawrence\getaddress\Address('Addr1', 'Addr2', 'Addr3', 'Addr4', '', 'Postal Town');
        $this->assertEquals('Postal Town', $address->getNormalisedTown());
    }
}
