<?php

namespace petelawrence\getaddress;

class GetAddressResponse {


    private $longitude;

    private $latitude;

    private $addresses;


    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }


    public function getLongitude()
    {
        return $this->longitude;
    }


    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }


    public function getLatitude()
    {
        return $this->latitude;
    }


    public function getAddresses()
    {
        return $this->addresses;
    }


    public function addAddress($address)
    {
        $this->addresses[] = $address;
    }

}