<?php


namespace AirlinePassengerManifest\Ticket;


interface ITicket
{
    public function getSeatNumber();
    public function getFlightNumber();
    public function getAirCraftInfo();
    public function getCompany();
    public function getBrand();
    public function getAircraft();
    public function getSeatClass();
    public function getAirlineCompany();
    public function getAirplaneType();
}
