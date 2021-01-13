<?php


namespace AirlinePassengerManifest;


use AirlinePassengerManifest\Enum\SeatClasses;
use Exception;

class Configuration
{
    public static function getAirplaneTypes($brand) {
        $airplaneTypes = [
            [
                'brand' => 'Boeing',
                'model' => '737-800'
            ],
            [
                'brand' => 'Airbus',
                'model' => 'A380'
            ],
            [
                'brand' => 'Dash',
                'model' => '8'
            ]
        ];

        $airplaneType = array_filter($airplaneTypes, function ($type) use ($brand) {
            return $brand == $type['brand'];
        });

        if (empty($airplaneType)) {
            throw new Exception('Invalid Brand');
        }

        return array_shift($airplaneType);
    }

    public static function getAirlineCompanies($carrierName) {
        $airlineCompanies = [
            [
                'carrierName' => 'Emirates',
                'headQuarters' => 'UAE'
            ],
            [
                'carrierName' => 'Qantas',
                'headQuarters' => 'Australia'
            ],
            [
                'carrierName' => 'Singapore Airlines',
                'headQuarters' => 'Singapore'
            ]
        ];

        $airlineCompany = array_filter($airlineCompanies, function ($type) use ($carrierName) {
            return $carrierName == $type['carrierName'];
        });

        if (empty($airlineCompany)) {
            throw new Exception('Invalid Carrier Name 1');
        }

        return array_shift($airlineCompany);
    }

    public static function getSeatConfiguration($airplaneBrand, $airlineCompany) {
        $config = [
            'Qantas' => [
                'Boeing' => [
                    SeatClasses::FIRST_CLASS_INDEX => 0,
                    SeatClasses::BUSINESS_INDEX => 13,
                    SeatClasses::PREMIUM_ECONOMY_INDEX=> 0,
                    SeatClasses::ECONOMY_INDEX => 162,
                ],
                'Airbus' => [
                    SeatClasses::FIRST_CLASS_INDEX => 14,
                    SeatClasses::BUSINESS_INDEX => 64,
                    SeatClasses::PREMIUM_ECONOMY_INDEX=> 35,
                    SeatClasses::ECONOMY_INDEX => 371,
                ],
                'Dash' => [
                    SeatClasses::FIRST_CLASS_INDEX => 0,
                    SeatClasses::BUSINESS_INDEX => 0,
                    SeatClasses::PREMIUM_ECONOMY_INDEX=> 0,
                    SeatClasses::ECONOMY_INDEX => 38,
                ],
            ],
            'Singapore Airlines' => [
                'Boeing' => [
                    SeatClasses::FIRST_CLASS_INDEX => 0,
                    SeatClasses::BUSINESS_INDEX => 8,
                    SeatClasses::PREMIUM_ECONOMY_INDEX=> 14,
                    SeatClasses::ECONOMY_INDEX => 160,
                ],
                'Airbus' => [
                    SeatClasses::FIRST_CLASS_INDEX => 12,
                    SeatClasses::BUSINESS_INDEX => 80,
                    SeatClasses::PREMIUM_ECONOMY_INDEX=> 40,
                    SeatClasses::ECONOMY_INDEX => 360,
                ],
                'Dash' => [
                    SeatClasses::FIRST_CLASS_INDEX => 0,
                    SeatClasses::BUSINESS_INDEX => 0,
                    SeatClasses::PREMIUM_ECONOMY_INDEX=> 4,
                    SeatClasses::ECONOMY_INDEX => 30,
                ],
            ],
            'Singapore Emirates' => [
                'Boeing' => [
                    SeatClasses::FIRST_CLASS_INDEX => 4,
                    SeatClasses::BUSINESS_INDEX => 8,
                    SeatClasses::PREMIUM_ECONOMY_INDEX=> 6,
                    SeatClasses::ECONOMY_INDEX => 150,
                ],
                'Airbus' => [
                    SeatClasses::FIRST_CLASS_INDEX => 16,
                    SeatClasses::BUSINESS_INDEX => 64,
                    SeatClasses::PREMIUM_ECONOMY_INDEX=> 50,
                    SeatClasses::ECONOMY_INDEX => 3000,
                ],
                'Dash' => [
                    SeatClasses::FIRST_CLASS_INDEX => 0,
                    SeatClasses::BUSINESS_INDEX => 0,
                    SeatClasses::PREMIUM_ECONOMY_INDEX=> 0,
                    SeatClasses::ECONOMY_INDEX => 40,
                ],
            ]
        ];

        if (empty($airlineCompany) || !isset($config[$airlineCompany])) {
            throw new Exception('Invalid Carrier Name 2');
        }

        if (empty($airplaneBrand) || !isset($config[$airlineCompany][$airplaneBrand])) {
            throw new Exception('Invalid Brand');
        }


        return $config[$airlineCompany][$airplaneBrand];
    }
}
