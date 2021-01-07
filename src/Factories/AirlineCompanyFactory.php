<?php

namespace AirlinePassengerManifest\Factories;


use AirlinePassengerManifest\AirlineCompanies\QantasAirlineCompany;
use Exception;

class AirlineCompanyFactory
{

    public static function create($name)
    {
        $airlineCompany = null;
        switch ($name) {
            case 'Qantas';
                $airlineCompany = new QantasAirlineCompany();
                break;

            default;

                //nothing
        }

        if (null === $airlineCompany) {
            throw new Exception('Invalid Company');
        }

        return $airlineCompany;
    }
}
