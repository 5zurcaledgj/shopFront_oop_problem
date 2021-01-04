<?php

namespace Plane\Factories;

use Plane\AirplaneTypes\BoeingAirplaneType;
use Plane\Exceptions\MissingAirplaneTypeException;

class AirplaneTypeFactory extends FactoryAbstract implements FactoryInterface
{

    public function create()
    {
        $airplane = null;
        switch ($this->name) {
            case 'Boeing';
                $airplane = new BoeingAirplaneType();
                break;

           default;
                //nothing
        }

        if (null === $airplane) {
            throw new MissingAirplaneTypeException();
        }

        return $airplane;
    }
}
