<?php


namespace AirlinePassengerManifest\AirlineCompanies;

use AirlinePassengerManifest\Enum\AirplaneTypes;
use AirlinePassengerManifest\Enum\SeatClasses;

class EmiratesAirlineCompany extends AirlineCompanyAbstract
{
    private $config = [
        AirplaneTypes::BOEING => [
            SeatClasses::FIRST_CLASS_INDEX => 4,
            SeatClasses::BUSINESS_INDEX => 8,
            SeatClasses::PREMIUM_ECONOMY_INDEX => 6,
            SeatClasses::ECONOMY_INDEX => 150,
        ],
        AirplaneTypes::AIRBUS => [
            SeatClasses::FIRST_CLASS_INDEX => 16,
            SeatClasses::BUSINESS_INDEX => 64,
            SeatClasses::PREMIUM_ECONOMY_INDEX => 50,
            SeatClasses::ECONOMY_INDEX => 300,
        ],
        AirplaneTypes::DASH => [
            SeatClasses::FIRST_CLASS_INDEX => 0,
            SeatClasses::BUSINESS_INDEX => 0,
            SeatClasses::PREMIUM_ECONOMY_INDEX => 0,
            SeatClasses::ECONOMY_INDEX => 40,
        ],
    ];

    private $headquarters = 'UAE';
    private $carrierName = 'Emirates';
}
