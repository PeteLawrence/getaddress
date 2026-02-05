<?php

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    public function testCreateAddress()
    {
        $address = new \petelawrence\getaddress\Address('Addr1', 'Addr2', 'Addr3', 'Addr4', 'Town', 'Postal Town', 'County');
        $this->assertEquals('Addr1', $address->getLine1());
        $this->assertEquals('Addr2', $address->getLine2());
        $this->assertEquals('Addr3', $address->getLine3());
        $this->assertEquals('Addr4', $address->getLine4());
        $this->assertEquals('Town', $address->getTown());
        $this->assertEquals('Postal Town', $address->getPostalTown());
        $this->assertEquals('County', $address->getCounty());
    }


    public function testGetNormalisedTown1()
    {
        $address = new \petelawrence\getaddress\Address('Addr1', 'Addr2', 'Addr3', 'Addr4', 'Town', 'Postal Town');
        $this->assertEquals('Town', $address->getNormalisedTown());
    }


    public function testGetNormalisedTown2()
    {
        $address = new \petelawrence\getaddress\Address('Addr1', 'Addr2', 'Addr3', 'Addr4', 'Town');
        $this->assertEquals('Town', $address->getNormalisedTown());
    }


    public function testGetNormalisedTown3()
    {
        $address = new \petelawrence\getaddress\Address('Addr1', 'Addr2', 'Addr3', 'Addr4', '', 'Postal Town');
        $this->assertEquals('Postal Town', $address->getNormalisedTown());
    }
}
