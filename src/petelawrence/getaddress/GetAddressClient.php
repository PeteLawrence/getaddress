<?php

namespace petelawrence\getaddress;

class GetAddressClient
{
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
     * @param string $houseNumOrName Used to filter results, but not supported by Ideal Postcodes
     *
     * @return petelawrence\getaddress\Address[]
     */
    public function lookup($postcode, $houseNumOrName = '')
    {
        //Create a new Guzzle client
        $guzzleClient = new \GuzzleHttp\Client(
            [
                'base_uri' => 'https://api.ideal-postcodes.co.uk/v1/postcodes/'
            ]
        );

        //Perform the query
        try {
            $response = $guzzleClient->get(
                sprintf('%s?api_key=%s', $postcode, $this->apiKey),
            );
        } catch (\Exception $e) {
            if ($e->getResponse()->getStatusCode() == 401) {
                throw new GetAddressAuthenticationException('getaddress.io authentication failed');
            }

            //Default exception
            throw new GetAddressLookupException('An error occurred performing the lookup');
        }

        $result = $this->parseResponse($response->getBody()->getContents());

        return $result;
    }


    public function parseResponse($response)
    {
        //Convert the response from JSON into an object
        $responseObj = json_decode($response);

        $getAddressResponse = new \petelawrence\getaddress\GetAddressResponse();

        //Set the longitude and latitude fields (for Ideal Postcodes get from the first address)
        $getAddressResponse->setLongitude($responseObj->result[0]->longitude);
        $getAddressResponse->setLatitude($responseObj->result[0]->latitude);

        //Set the address fields
        foreach ($responseObj->result as $address) {
            // NR10 4JJ postcodes via Ideal Postcodes have 'Reepham' in line 3 as well as dependant_locality..
            $line2 = $address->line_2 !== $address->dependant_locality
                ? $address->line_2
                : '';

            $line3 = $address->line_3 !== $address->dependant_locality
                ? $address->line_3
                : '';

            $getAddressResponse->addAddress(
                new Address(
                    trim($address->line_1), // addr1
                    trim($line2), // addr2
                    trim($line3), // addr3
                    '', // addr4 - not supplied by Ideal Postcodes
                    trim($address->dependant_locality), // town/locality
                    trim($address->post_town), // postal town
                    trim($address->county) // county
                )
            );
        }

        return $getAddressResponse;
    }
}
