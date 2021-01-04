<?php


namespace Plane\AirplaneTypes;


class BoeingAirplaneType extends AirplaneTypeAbstract
{

    public function __construct()
    {
        parent::setModel('737-800')
            ::setBrand('Boeing')
            ::setBusiness(13)
            ::setPremiumEconomy(0)
            ::setFirstClass(0)
            ::setEconomySeats(162);
    }

}
