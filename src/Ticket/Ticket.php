<?php


namespace AirlinePassengerManifest\Ticket;

use Exception;

class Ticket implements TicketInterface
{
    private $seatNumber;
    private $class;
    private $brand;
    private $airlineCompany;

    public function __construct($seatNumber, $class, $brand, $airlineCompany)
    {
        $this->seatNumber = $seatNumber;
        $this->class = $class;
        $this->brand = $brand;
        $this->airlineCompany = $airlineCompany;


        if (is_null($this->seatNumber)) {
            throw new Exception('Invalid SeatNumber');
        }

        if (is_null($this->class)) {
            throw new Exception('Invalid Class');
        }

        if (is_null($this->brand)) {
            throw new Exception('Invalid Brand');
        }

        if (is_null($this->airlineCompany)) {
            throw new Exception('Invalid Company');
        }
    }

    public function getSeatNumber()
    {
        // TODO: Implement getSeatNumber() method.
    }

    public function getFlightNumber()
    {
        // TODO: Implement getFlightNumber() method.
    }

    public function getAirCraftInfo()
    {
        // TODO: Implement getAirCraftInfo() method.
    }

    public function getCompany()
    {
        return $this->airlineCompany;
    }

    public function getBrand()
    {
        return $this->brand;
    }
}
