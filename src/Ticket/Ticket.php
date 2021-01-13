<?php


namespace AirlinePassengerManifest\Ticket;

use AirlinePassengerManifest\Aircraft\Aircraft;
use AirlinePassengerManifest\AirlineCompany\AirlineCompany;
use AirlinePassengerManifest\AirplaneType\AirplaneType;
use AirlinePassengerManifest\Configuration;
use AirlinePassengerManifest\IPassenger;
use TicketException;

class Ticket implements ITicket
{
    private $seatNumber;
    private $seatClass;
    private $aircraft;
    private $flightNumber;

    public function __construct($seatNumber, $seatClass, $brand, $airlineCompany)
    {
        $this->seatNumber = $seatNumber;
        $this->seatClass = $seatClass;
        $this->brand = $brand;
        $this->airlineCompany = $airlineCompany;


        if (is_null($this->seatNumber)) {
            throw new TicketException('Invalid SeatNumber');
        }

        if (is_null($this->seatClass)) {
            throw new TicketException('Invalid Class');
        }

        if (is_null($this->brand)) {
            throw new TicketException('Invalid Brand');
        }

        if (is_null($this->airlineCompany)) {
            throw new TicketException('Invalid Company');
        }

        $airplane = Configuration::getAirplaneTypes($brand);
        $airplaneType = new AirplaneType($airplane['brand'], $airplane['model']);

        $company = Configuration::getAirlineCompanies($airlineCompany);
        $_airlineCompany = new AirlineCompany($company['carrierName'], $company['headQuarters']);

        //This initializes the instance of the aircraft
        $this->aircraft = Aircraft::getInstance($_airlineCompany, $airplaneType);
    }

    public function getSeatNumber()
    {
        return $this->seatNumber;
    }

    public function getFlightNumber()
    {
        return $this->flightNumber;
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

    public function getAircraft()
    {
        return $this->aircraft;
    }

    public function getSeatClass()
    {
        return $this->seatClass;
    }
}
