<?php


namespace AirlinePassengerManifest\Ticket;

use AirlinePassengerManifest\Aircraft\Aircraft;
use AirlinePassengerManifest\AirlineCompany\AirlineCompany;
use AirlinePassengerManifest\AirlineCompany\IAirlineCompany;
use AirlinePassengerManifest\AirplaneType\AirplaneType;
use AirlinePassengerManifest\AirplaneType\IAirplaneType;
use AirlinePassengerManifest\Configuration;
use AirlinePassengerManifest\IPassenger;
use TicketException;

class Ticket implements ITicket
{
    private $seatNumber;
    private $seatClass;
    private $aircraft;
    private $flightNumber;
    private $airlineCompany;
    /**
     * @var AirplaneType
     */
    private $airplaneType;

    public function __construct($seatNumber, $seatClass, $brand, $airlineCompany)
    {
        $this->seatNumber = $seatNumber;
        $this->seatClass = $seatClass;

        if (is_null($this->seatNumber)) {
            throw new TicketException('Invalid SeatNumber');
        }

        if (is_null($this->seatClass)) {
            throw new TicketException('Invalid Class');
        }

        if (is_null($brand)) {
            throw new TicketException('Invalid Brand');
        }

        if (is_null($airlineCompany)) {
            throw new TicketException('Invalid Company');
        }

        $airplane = Configuration::getAirplaneTypes($brand);
        $this->airplaneType = new AirplaneType($airplane['brand'], $airplane['model']);

        $company = Configuration::getAirlineCompanies($airlineCompany);
        $this->airlineCompany = new AirlineCompany($company['carrierName'], $company['headQuarters']);

        //This initializes the instance of the aircraft
        $this->aircraft = Aircraft::getInstance($this->airlineCompany, $this->airplaneType);
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

    public function getAirlineCompany() : IAirlineCompany
    {
        return $this->airlineCompany;
    }

    public function getAirplaneType() : IAirplaneType
    {
        return $this->airplaneType;
    }

    public function getBrand()
    {
        return $this->airplaneType->getBrand();
    }

    public function getAircraft()
    {
        return $this->aircraft;
    }

    public function getSeatClass()
    {
        return $this->seatClass;
    }

    public function getCompany()
    {
        return $this->airlineCompany->getCarrierName();
    }
}
