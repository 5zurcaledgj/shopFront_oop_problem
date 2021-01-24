<?php

namespace AirlinePassengerManifest\Aircraft;


use AirlinePassengerManifest\AirlineCompany\IAirlineCompany;
use AirlinePassengerManifest\AirplaneType\IAirplaneType;
use AirlinePassengerManifest\Collections\PassengerCollection;
use AirlinePassengerManifest\Collections\SeatClassCollection;
use AirlinePassengerManifest\Configuration;
use AirlinePassengerManifest\Enum\ESeatClasses;
use AirlinePassengerManifest\IPassenger;
use AirlinePassengerManifest\SeatClass;

class Aircraft implements IAircraft
{
    private static $instances = [];
    private $company;
    private $airplaneType;
    private $seats;
    private $configuration;

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
        return array_reduce(array_keys($this->seats), function($partialTotal, $class) {
            $partialTotal += $this->getSeat($class);
            return $partialTotal;
        }, 0);
    }

    public function getAvailableSeats($seatClass) {
        return $this->configuration[$seatClass] - $this->getOccupiedSeats($seatClass);
    }

    public function getOccupiedSeats($seatClass) {
        return $this->seats->get(ESeatClasses::getName($seatClass))->getNumberOfPassengers();
    }

    public function getPassengerList() {
//        $list = "";
//        foreach ($this->seats as $class => $pasengers) {
//            foreach ($pasengers as $seatNumber => $pasenger) {
//                $_seatNumber = $seatNumber + 1;
//                $list .= "Name: {$pasenger['name']}, Age: {$pasenger['age']},
//                    Sex: {$pasenger['sex']}, Seat: {$this->getClassName($class)} {$_seatNumber}";
//            }
//        }

        return $this->seats;
    }

    public function addPassenger(IPassenger $passenger) : IPassenger {
        $passengerClass = $passenger->getSeatClass();
        if (!$this->getAvailableSeats($passengerClass)) {
            throw new \Exception('No Available seat');
        }

        return $this->seats->get(ESeatClasses::getName($passengerClass))->addPassenger($passenger);

    }
}
