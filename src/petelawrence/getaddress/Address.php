<?php

namespace petelawrence\getaddress;

class Address {


    private $addr1;
    private $addr2;
    private $addr3;
    private $addr4;
    private $town;
    private $postalTown;
    private $county;

    public function __construct($addr1, $addr2 = '', $addr3 = '', $addr4 = '', $town = '', $postalTown = '', $county = '')
    {
        $this->addr1 = $addr1;
        $this->addr2 = $addr2;
        $this->addr3 = $addr3;
        $this->addr4 = $addr4;
        $this->town = $town;
        $this->postalTown = $postalTown;
        $this->county = $county;
    }


    public function getAddr1()
    {
        return $this->addr1;
    }


    public function getAddr2()
    {
        return $this->addr2;
    }

    public function getAddr3()
    {
        return $this->addr3;
    }


    public function getAddr4()
    {
        return $this->addr4;
    }


    public function getTown()
    {
        return $this->town;
    }


    public function getPostalTown()
    {
        return $this->postalTown;
    }


    public function getCounty()
    {
        return $this->county;
    }

}