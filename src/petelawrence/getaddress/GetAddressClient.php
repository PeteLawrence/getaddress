<?php

namespace petelawrence\getaddress;

class GetAddressClient {


    private $apiKey;

    public function __construct($apiKey)
    {
        if ($apiKey == '') {
            throw new \Exception('No apiKey provided');
        }

        $this->apiKey = $apiKey;
    }


    /**
     * Queries getaddress.io for houses with the given postcode
     *
     * @param string $postcode       The postcode to return houses for
     * @param string $houseNumOrName If supplied will limit results to those that contain this value
     *
     * @return petelawrence\getaddress\Address[]
     */
    public function lookup($postcode, $houseNumOrName = '')
    {
        //Create a new Guzzle client
        $guzzleClient = new \GuzzleHttp\Client(
            [
                'base_uri' => 'https://api.getAddress.io/v2/uk/'
            ]
        );

        //Perform the query
        $response = $guzzleClient->get(
            sprintf('%s/%s', $postcode, $houseNumOrName),
            [
                'auth'=> ['api-key', $this->apiKey]
            ]
        );

        $result = $this->parseResponse($response->getBody()->getContents());

        return $result;

    }


    public function parseResponse($response)
    {
        //Convert the response from JSON into an object
        $responseObj = json_decode($response);

        $getAddressResponse = new \petelawrence\getaddress\getAddressResponse();

        //Set the longitude and latitude fields
        $getAddressResponse->setLongitude($responseObj->Longitude);
        $getAddressResponse->setLatitude($responseObj->Latitude);

        //Set the address fields
        foreach ($responseObj->Addresses as $addressLine) {
            $addressParts = explode(',', $addressLine);
            $getAddressResponse->addAddress(
                new Address(
                    trim($addressParts[0]), //addr1
                    trim($addressParts[1]), //addr2
                    trim($addressParts[2]), //addr3
                    trim($addressParts[3]), //addr4
                    trim($addressParts[4]), //town
                    trim($addressParts[5]), //postal town
                    trim($addressParts[6]) //county
                )
            );
        }

        return $getAddressResponse;
    }

}