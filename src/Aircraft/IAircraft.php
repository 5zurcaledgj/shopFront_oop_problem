<?php


namespace AirlinePassengerManifest\Aircraft;


use AirlinePassengerManifest\IPassenger;

interface IAircraft
{
    public function getSeats();
    public function getAvailableSeats($seatClass);
    public function getOccupiedSeats($seatClass);
    public function getPassengerList();
    public function addPassenger(IPassenger $passenger);

}