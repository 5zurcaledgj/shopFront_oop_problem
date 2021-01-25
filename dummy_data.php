<?php

use AirlinePassengerManifest\Configuration;
use AirlinePassengerManifest\Enum\ESex;
use AirlinePassengerManifest\Enum\ESeatClasses;

// Generates list of random passengers.
// No 2 people has the same name :D
// But there can be 2 people with the same ticket, meaning, same Class, same seat number, and same flight

function generatePassengers($numberOfPassengers = 10) {
    $passengers = [];
    for($i = 0; $i < $numberOfPassengers; $i++) {
        $_passenger = generatePerson();
        while(isset($passengers[$_passenger['name']])) {
            $_passenger['name'] .= ' ' . generateName();
        }

        $passengers[$_passenger['name']] = $_passenger;
    }

    return $passengers;
}

function generateName() {
    $names = ['James', 'John', 'Robert', 'Michael', 'William', 'David', 'Richard', 'Joseph', 'Thomas', 'Charles', 'Christopher', 'Daniel', 'Matthew', 'Anthony', 'Donald', 'Mark', 'Paul', 'Steven', 'Andrew', 'Kenneth'];

    return $names[rand(0, count($names) - 1)];
}

function generatePerson() {
    $name = generateName();
    $age = rand(10, 50); //ayaw ko sa matatanda
    $sexes = [ESex::MALE, ESex::FEMALE];
    $sex = $sexes[rand(0,1)];
    $ticket = generateRandomTicket();
    return compact("name", "age", "sex", 'ticket');
}

function generateRandomTicket() {
    //ticketNumber
    $ticketNumbers = array_keys(Configuration::getFlight());
    $ticketNumber = $ticketNumbers[rand(0, count($ticketNumbers) - 1)];
    $ticketData = Configuration::getFlight($ticketNumber);
    $config = Configuration::getSeatConfiguration($ticketData['brand'], $ticketData['company']);
    $availability = 0;
    while(!$availability) {
        //Generate Seat Class
        $seatClass = rand(0, count(ESeatClasses::getAll()));
        $availability = $config[$seatClass];
    }

    $seatNumber = rand(1, $config[$seatClass]);

    return compact('seatNumber', 'seatClass', 'ticketNumber');
}