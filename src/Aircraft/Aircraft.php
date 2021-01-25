<?php

namespace AirlinePassengerManifest\Aircraft;


use AirlinePassengerManifest\AirlineCompany\IAirlineCompany;
use AirlinePassengerManifest\AirplaneType\IAirplaneType;
use AirlinePassengerManifest\Collections\SeatClassCollection;
use AirlinePassengerManifest\Configuration;
use AirlinePassengerManifest\Enum\ESeatClasses;
use AirlinePassengerManifest\Enum\ESex;
use AirlinePassengerManifest\IPassenger;
use AirlinePassengerManifest\SeatClass;

class Aircraft implements IAircraft
{
    private static $instances = [];
    private $company;
    private $airplaneType;
    private $seats;
    private $configuration;
    private $terminal;
    private $flightNumber;
    private $destination;

    /**
     * @return mixed
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * @param mixed $terminal
     * @return Aircraft
     */
    public function setTerminal($terminal)
    {
        $this->terminal = $terminal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    /**
     * @param mixed $flightNumber
     * @return Aircraft
     */
    public function setFlightNumber($flightNumber)
    {
        $this->flightNumber = $flightNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     * @return Aircraft
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
        return $this;
    }

    private function __construct(IAirlineCompany $company, IAirplaneType $airplaneType)
    {
        $this->airplaneType = $airplaneType;
        $this->company = $company;
        $this->initSeatCollection();
        $this->configuration = Configuration::getSeatConfiguration($airplaneType->getModel(), $company->getCarrierName());
    }

    public function initSeatCollection() {
        $seats = [];
        foreach (ESeatClasses::getAll() as $classIndex => $name) {
            $seats[$name] = new SeatClass($name, $classIndex);
        }

        $this->seats = new SeatClassCollection($seats);
    }

    public function getAircraftInfo() {
        return sprintf('Destination: %s, Terminal: %s, Flight Number: %s', $this->destination, $this->terminal, $this->flightNumber);
    }

    public static function getInstance(IAirlineCompany $company, IAirplaneType $airplaneType) : IAircraft
    {
        $carrierName = $company->getCarrierName();
        $brand = $airplaneType->getBrand();
        if (self::$instances[$carrierName][$brand]) {
            return self::$instances[$carrierName][$brand];
        }

        self::$instances[$carrierName][$brand] = new self($company, $airplaneType);

        return self::$instances[$carrierName][$brand];
    }

    public function getSeats() {
        return array_map(function ($seatClass) {
            return $this->configuration[$seatClass];
        }, array_flip(ESeatClasses::getAll()));
    }


    private function _getAvailableSeats($seatClass) {
        return $this->configuration[$seatClass] - $this->_getOccupiedSeats($seatClass);
    }

    private function _getOccupiedSeats($seatClass) {
        return $this->seats->get(ESeatClasses::getName($seatClass))->getNumberOfPassengers();
    }

    public function getAvailableSeats($seatClass = null)
    {
        if (null === $seatClass) {
            return array_map(function ($seatClass) {
                return $this->_getAvailableSeats($seatClass);
            }, array_flip(ESeatClasses::getAll()));
        }

        return $this->_getAvailableSeats($seatClass);
    }

    public function getOccupiedSeats($seatClass = null)
    {
        if (null === $seatClass) {
            return array_map(function ($seatClass) {
                return $this->_getOccupiedSeats($seatClass);
            }, array_flip(ESeatClasses::getAll()));
        }

        return $this->_getOccupiedSeats($seatClass);
    }

    public function getPassengerList() {
        $list = [];
        foreach (ESeatClasses::getAll() as $seatClassIndex => $className) {
            $list[$className] = array_map(function (IPassenger $passenger) {
                $sex = ESex::getName($passenger->getSex());

                return "{$passenger->getName()}, {$passenger->getAge()}, {$sex}";
            }, $this->seats->get($className)->getPassengers()->getAll());
        }

        return $list;
    }

    public function addPassenger(IPassenger $passenger) : IPassenger {
        $passengerClass = $passenger->getSeatClass();
        if (!$this->_getAvailableSeats($passengerClass)) {
            throw new \Exception('No Available seat');
        }

        return $this->seats->get(ESeatClasses::getName($passengerClass))->addPassenger($passenger);

    }


}
