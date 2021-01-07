<?php



require_once realpath('vendor/autoload.php');

use AirlinePassengerManifest\Passenger;

$passenger = new Passenger('joshua', 4, 'male');
$passenger->setTicket([
    'seatNumber' => 4,
    'class' => \AirlinePassengerManifest\Enum\SeatClasses::ECONOMY_INDEX,
    'brand' => \AirlinePassengerManifest\Enum\AirplaneTypes::BOEING,
    'airlineCompany' => \AirlinePassengerManifest\Enum\AirlineCompanies::QANTAS
]);
$passenger->checkIn();

print_r($passenger);
