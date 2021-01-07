<?php

namespace AirlinePassengerManifest\Ticket;

Interface TicketInterface {

    public function getSeatNumber();
    public function getFlightNumber();
    public function getAirCraftInfo();
    public function getCompany();
    public function getBrand();
}
