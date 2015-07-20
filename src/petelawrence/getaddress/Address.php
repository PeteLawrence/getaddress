<?php

namespace petelawrence\getaddress;


/**
 * An individual address returned from the getaddress.io API
 */
class Address
{

    private $addr1;
    private $addr2;
    private $addr3;
    private $addr4;
    private $town;
    private $postalTown;
    private $county;


    /**
     * Instantiates a new Address object
     *
     * @param string $addr1      Address Line 1
     * @param string $addr2      Address Line 2
     * @param string $addr3      Address Line 3
     * @param string $addr4      Address Line 4
     * @param string $town       Town
     * @param string $postalTown Postal Town
     * @param string $county     County
     */
    public function __construct(
        $addr1,
        $addr2 = '',
        $addr3 = '',
        $addr4 = '',
        $town = '',
        $postalTown = '',
        $county = ''
    ) {
        $this->addr1 = $addr1;
        $this->addr2 = $addr2;
        $this->addr3 = $addr3;
        $this->addr4 = $addr4;
        $this->town = $town;
        $this->postalTown = $postalTown;
        $this->county = $county;
    }


    /**
     * Returns address line 1
     *
     * @return string
     */
    public function getAddr1()
    {
        return $this->addr1;
    }


    /**
     * Returns address line 2
     *
     * @return string
     */
    public function getAddr2()
    {
        return $this->addr2;
    }


    /**
     * Returns address line 3
     *
     * @return string
     */
    public function getAddr3()
    {
        return $this->addr3;
    }


    /**
     * Returns address line 4
     *
     * @return string
     */
    public function getAddr4()
    {
        return $this->addr4;
    }


    /**
     * Returns town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }


    /**
     * Returns postal town
     *
     * @return string
     */
    public function getPostalTown()
    {
        return $this->postalTown;
    }


    /**
     * Returns county
     *
     * @return string
     */
    public function getCounty()
    {
        return $this->county;
    }
}
