<?php

namespace petelawrence\getaddress;

/**
 * An individual address returned from the getaddress.io API
 */
class Address
{
    private $line1;
    private $line2;
    private $line3;
    private $line4;
    private $town;
    private $postalTown;
    private $county;


    /**
     * Instantiates a new Address object
     *
     * @param string $line1      Line 1
     * @param string $line2      Line 2
     * @param string $line3      Line 3
     * @param string $line4      Line 4
     * @param string $town       Town
     * @param string $postalTown Postal Town
     * @param string $county     County
     */
    public function __construct(
        $line1,
        $line2 = '',
        $line3 = '',
        $line4 = '',
        $town = '',
        $postalTown = '',
        $county = ''
    ) {
        $this->line1 = $line1;
        $this->line2 = $line2;
        $this->line3 = $line3;
        $this->line4 = $line4;
        $this->town = $town;
        $this->postalTown = $postalTown;
        $this->county = $county;
    }


    /**
     * Returns line 1
     *
     * @return string
     */
    public function getLine1()
    {
        return $this->line1;
    }


    /**
     * Returns line 2
     *
     * @return string
     */
    public function getLine2()
    {
        return $this->line2;
    }


    /**
     * Returns line 3
     *
     * @return string
     */
    public function getLine3()
    {
        return $this->line3;
    }


    /**
     * Returns line 4
     *
     * @return string
     */
    public function getLine4()
    {
        return $this->line4;
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
     * Returns the most appropriate of the two town fields
     *
     * @return string [description]
     */
    public function getNormalisedTown()
    {
        if ($this->town != '') {
            return $this->town;
        }

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


    public function toCsv()
    {
        return sprintf('%s,%s,%s,%s,%s,%s,%s', $this->getLine1(), $this->getLine2(), $this->getLine3(), $this->getLine4(), $this->getTown(), $this->getPostalTown(), $this->getCounty());
    }
}
