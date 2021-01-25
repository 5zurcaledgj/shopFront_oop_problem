<?php


namespace AirlinePassengerManifest;


use AirlinePassengerManifest\Enum\ESeatClasses;
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
                    ESeatClasses::FIRST_CLASS_INDEX => 0,
                    ESeatClasses::BUSINESS_INDEX => 13,
                    ESeatClasses::PREMIUM_ECONOMY_INDEX=> 0,
                    ESeatClasses::ECONOMY_INDEX => 162,
                ],
                'Airbus' => [
                    ESeatClasses::FIRST_CLASS_INDEX => 14,
                    ESeatClasses::BUSINESS_INDEX => 64,
                    ESeatClasses::PREMIUM_ECONOMY_INDEX=> 35,
                    ESeatClasses::ECONOMY_INDEX => 371,
                ],
                'Dash' => [
                    ESeatClasses::FIRST_CLASS_INDEX => 0,
                    ESeatClasses::BUSINESS_INDEX => 0,
                    ESeatClasses::PREMIUM_ECONOMY_INDEX=> 0,
                    ESeatClasses::ECONOMY_INDEX => 38,
                ],
            ],
            'Singapore Airlines' => [
                'Boeing' => [
                    ESeatClasses::FIRST_CLASS_INDEX => 0,
                    ESeatClasses::BUSINESS_INDEX => 8,
                    ESeatClasses::PREMIUM_ECONOMY_INDEX=> 14,
                    ESeatClasses::ECONOMY_INDEX => 160,
                ],
                'Airbus' => [
                    ESeatClasses::FIRST_CLASS_INDEX => 12,
                    ESeatClasses::BUSINESS_INDEX => 80,
                    ESeatClasses::PREMIUM_ECONOMY_INDEX=> 40,
                    ESeatClasses::ECONOMY_INDEX => 360,
                ],
                'Dash' => [
                    ESeatClasses::FIRST_CLASS_INDEX => 0,
                    ESeatClasses::BUSINESS_INDEX => 0,
                    ESeatClasses::PREMIUM_ECONOMY_INDEX=> 4,
                    ESeatClasses::ECONOMY_INDEX => 30,
                ],
            ],
            'Emirates' => [
                'Boeing' => [
                    ESeatClasses::FIRST_CLASS_INDEX => 4,
                    ESeatClasses::BUSINESS_INDEX => 8,
                    ESeatClasses::PREMIUM_ECONOMY_INDEX=> 6,
                    ESeatClasses::ECONOMY_INDEX => 150,
                ],
                'Airbus' => [
                    ESeatClasses::FIRST_CLASS_INDEX => 16,
                    ESeatClasses::BUSINESS_INDEX => 64,
                    ESeatClasses::PREMIUM_ECONOMY_INDEX=> 50,
                    ESeatClasses::ECONOMY_INDEX => 3000,
                ],
                'Dash' => [
                    ESeatClasses::FIRST_CLASS_INDEX => 0,
                    ESeatClasses::BUSINESS_INDEX => 0,
                    ESeatClasses::PREMIUM_ECONOMY_INDEX=> 0,
                    ESeatClasses::ECONOMY_INDEX => 40,
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

    public static function getFlight($flightNumber = null) {
        $flights = [
            'BQ23423' => [
                'destination' => 'Manila, Philippines',
                'terminal' => 'B2',
                'brand' => 'Boeing',
                'company' => 'Qantas',
                'flightNumber' => 'BQ23423'
            ],
            'DE34245' => [
                'destination' => 'Singapore, Singapore',
                'terminal' => 'B5',
                'brand' => 'Dash',
                'company' => 'Emirates',
                'flightNumber' => 'DE34245'
            ],
            'AQE56982' => [
                'destination' => 'Los Angeles, California',
                'terminal' => 'A4',
                'brand' => 'Airbus',
                'company' => 'Qantas',
                'flightNumber' => 'AQE56982'
            ],
            'BSE56982' => [
                'destination' => 'Los Angeles, California',
                'terminal' => 'A4',
                'brand' => 'Boeing',
                'company' => 'Singapore Airlines',
                'flightNumber' => 'BSE56982'
            ]
        ];

        if (null === $flightNumber) {
            return $flights;
        }

        if (isset($flights[$flightNumber])) {
            return $flights[$flightNumber];
        }

        throw new Exception('Invalid flight number');
    }
}
