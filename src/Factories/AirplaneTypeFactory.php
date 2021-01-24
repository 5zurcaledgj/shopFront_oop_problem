<?php

namespace AirlinePassengerManifest\Factories;

use AirlinePassengerManifest\AirlineCompany\AirlineCompany;
use AirlinePassengerManifest\AirplaneType\AirplaneType;
use AirlinePassengerManifest\AirplaneTypes\BoeingAirplaneType;
use AirlinePassengerManifest\Configuration;
use AirlinePassengerManifest\Enum\AirplaneTypes;
use Exception;

class AirplaneTypeFactory
{

    public static function create($name)
    {
        $airplaneType = null;
        $airplaneTypeData = Configuration::getAirplaneTypes($name);
        if (null === $airplaneTypeData) {
            throw new Exception('Invalid Airplane Type');
        }

        return new AirplaneType($airplaneTypeData['brand'], $airplaneTypeData['model']) ;
    }
}
