<?php

require_once realpath('vendor/autoload.php');
require_once 'func.php';
require_once 'dummy_data.php';

use AirlinePassengerManifest\Aircraft\Aircraft;
use AirlinePassengerManifest\Factories\AirlineCompanyFactory;
use AirlinePassengerManifest\Factories\AirplaneTypeFactory;
use AirlinePassengerManifest\Passenger;
use AirlinePassengerManifest\Ticket\Ticket;

$passengers = generatePassengers(20);
fn_print_r($passengers);
try {

    foreach ($passengers as $passenger_data) {
        $passenger = new Passenger($passenger_data['name'], $passenger_data['age'], $passenger_data['sex']);
        $ticket = $passenger_data['ticket'];
        $passengerTicket = new Ticket($ticket['seatNumber'], $ticket['seatClass'], $ticket['ticketNumber']);
        $passenger
            ->setTicket($passengerTicket)
            ->checkIn();
    }

    foreach (\AirlinePassengerManifest\Configuration::getFlight() as $flight) {
        $company = AirlineCompanyFactory::create($flight['company']);
        $airplaneType = AirplaneTypeFactory::create($flight['brand']);
        $aircraft = Aircraft::getInstance($company, $airplaneType);
        fn_print_r($aircraft->getAircraftInfo(), $aircraft->getPassengerList(),
            "Seat Config", $aircraft->getSeats(),
            "Available Seats", $aircraft->getAvailableSeats(),
            "Occupied Seats", $aircraft->getOccupiedSeats());
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

die();
