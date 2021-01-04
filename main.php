<?php

use Plane\Plane;

spl_autoload_register(function ($className) {
    include_once __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
});


$plane = new Plane(new \Plane\Factories\AirlineCompanyFactory('Qantas'), new \Plane\Factories\AirplaneTypeFactory('Boeing'));
$plane->checkInPassenger('Joshua','dela Cruz', 12, 'male');
$plane->checkInPassenger('Perry','Te', 158, 'male');
print_r($plane->getAvailableSeats());
print_r($plane->getOccupiedSeats());
print_r($plane->getSeats());
print_r($plane->getPassengerList());
print_r($plane->getBrand());
print_r($plane->getModel());
print_r($plane->getCarrierName());

print_r($plane->getHeadquarters());
