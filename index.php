<?php

require_once realpath('vendor/autoload.php');
require_once 'func.php';

use AirlinePassengerManifest\Aircraft\Aircraft;
use AirlinePassengerManifest\Enum\ESeatClasses;
use AirlinePassengerManifest\Factories\AirlineCompanyFactory;
use AirlinePassengerManifest\Factories\AirplaneTypeFactory;
use AirlinePassengerManifest\Passenger;
use AirlinePassengerManifest\Ticket\Ticket;

$passengers = require_once 'dummy_data.php';

try {

    foreach ($passengers as $passenger_data) {
        $passenger = new Passenger($passenger_data['name'], $passenger_data['age'], $passenger_data['sex']);
        $ticket = $passenger_data['ticket'];
        $passengerTicket = new Ticket($ticket['seatNumber'], $ticket['seatClass'], $ticket['brand'], $ticket['company']);
        $passenger
            ->setTicket($passengerTicket)
            ->checkIn();
    }

    $company = AirlineCompanyFactory::create('Qantas');
    $boeing = AirplaneTypeFactory::create('Boeing');

    $boeingQantas = Aircraft::getInstance($company, $boeing);

    fn_print_die($boeingQantas->getAvailableSeats(ESeatClasses::BUSINESS_INDEX));


} catch (Exception $e) {
    echo $e->getMessage();
}

fn_print_die($boeingQantas);
