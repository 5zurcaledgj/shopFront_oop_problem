<?php


namespace AirlinePassengerManifest\Aircraft;


use AirlinePassengerManifest\IPassenger;

interface IAircraft
{
    public function getAvailableSeats($seatClass = null);
    public function getOccupiedSeats($seatClass = null);
    public function getPassengerList();
    public function addPassenger(IPassenger $passenger);
    public function getTerminal();
    public function setTerminal($terminal);
    public function getFlightNumber();
    public function setFlightNumber($flightNumber);
    public function getDestination();
    public function setDestination($destination);
}