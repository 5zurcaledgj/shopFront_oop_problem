<?php

use AirlinePassengerManifest\Enum\Sex;
use AirlinePassengerManifest\Enum\ESeatClasses;

return [
    [
        'name' => 'Joshua',
        'age' => 25,
        'sex' => Sex::MALE,
        'ticket' => [
            'seatNumber' => 1,
            'seatClass' => ESeatClasses::BUSINESS_INDEX,
            'brand' => 'Boeing',
            'company' => 'Qantas'
        ]
    ],
    [
        'name' => 'Sheldon Cooper',
        'age' => 25,
        'sex' => Sex::MALE,
        'ticket' => [
            'seatNumber' => 1,
            'seatClass' => ESeatClasses::BUSINESS_INDEX,
            'brand' => 'Boeing',
            'company' => 'Qantas'
        ]
    ],
];
