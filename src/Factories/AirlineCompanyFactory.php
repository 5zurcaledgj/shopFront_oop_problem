<?php

namespace AirlinePassengerManifest\Factories;

use AirlinePassengerManifest\AirlineCompany\AirlineCompany;
use AirlinePassengerManifest\AirlineCompany\IAirlineCompany;
use AirlinePassengerManifest\Configuration;
use Exception;

class AirlineCompanyFactory
{

    public static function create($name) : IAirlineCompany
    {
        $airlineCompany = null;
        $companyData = Configuration::getAirlineCompanies($name);
        if (null === $companyData) {
            throw new Exception('Invalid Company');
        }

        return new AirlineCompany($companyData['carrierName'], $companyData['headQuarters']) ;
    }
}
