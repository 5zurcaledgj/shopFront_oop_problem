<?php

namespace Plane\Factories;

use Plane\AirlineCompanies\QantasAirlineCompany;
use Plane\AirplaneTypes\BoeingAirplaneType;
use Plane\Exceptions\MissingAirlineCompanyTypeException;
use Plane\Exceptions\MissingAirplaneTypeException;

class AirlineCompanyFactory extends FactoryAbstract implements FactoryInterface
{

    public function create()
    {
        $airlineCompany = null;
        switch ($this->name) {
            case 'Qantas';
                $airlineCompany = new QantasAirlineCompany();
                break;

            default;
                //nothing
        }

        if (null === $airlineCompany) {
            throw new MissingAirlineCompanyTypeException();
        }

        return $airlineCompany;
    }
}
