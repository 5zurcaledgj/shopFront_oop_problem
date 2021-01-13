<?php

require_once realpath('vendor/autoload.php');

use AirlinePassengerManifest\Enum\SeatClasses;
use AirlinePassengerManifest\Passenger;
use AirlinePassengerManifest\Ticket\Ticket;

try {
    $passenger = new Passenger('joshua', 4, 'male');
    $passengerTicket = new Ticket(4, SeatClasses::ECONOMY_INDEX, 'Boeing', 'Qantas');
} catch (Exception $e) {
    echo $e->getMessage();
}

print_r($passenger);
print_r($passengerTicket);
