# ~~getaddress~~ Ideal Postcodes
A PHP library for the [Ideal Postcodes](https://ideal-postcodes.co.uk) postcode lookup service.

## Important update

**GetAddress.io has been replaced with Ideal Postcodes.**

Following a High Court ruling in favour of Ideal Postcodes, *GetAddress.io* ceased operations in February 2026. The court found that GetAddress.io had unlawfully used Ideal Postcodes’ database and breached database rights and licensing terms.

As a result, this library and its documentation now reference **Ideal Postcodes** as the lookup provider.

More details can be found here:
https://blog.ideal-postcodes.co.uk/ideal-postcodes-wins-high-court-ruling

# Pre-requisites
You will require a [Ideal Postcodes](https://ideal-postcodes.co.uk) API key.

# Usage
    $client = new \petelawrence\getaddress\GetAddressClient('YOUR-IDEAL-POSTCODES-API-KEY');
    $result = $client->lookup('NR10 4JJ');
    $address0 = $result->getAddresses()[0];
    echo $address0->getTown();

# Tests
    GETADDRESSKEY=YOUR-IDEAL-POSTCODES-API-KEY vendor/bin/phpunit tests/