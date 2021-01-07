<?php

namespace AirlinePassengerManifest\Factories;

use AirlinePassengerManifest\AirplaneTypes\BoeingAirplaneType;
use AirlinePassengerManifest\Enum\AirplaneTypes;
use Exception;

class AirplaneTypeFactory
{

    public static function create($name)
    {
        $airplane = null;
        switch ($name) {
            case AirplaneTypes::BOEING;
                $airplane = new BoeingAirplaneType();
                break;

           default;
                //nothing
        }

        if (null === $airplane) {
            throw new Exception('Invalid Airplane Type');
        }

        return $airplane;
    }
}
