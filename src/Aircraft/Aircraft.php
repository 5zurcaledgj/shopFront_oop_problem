<?php

namespace AirlinePassengerManifest\Aircraft;


use AirlinePassengerManifest\AirlineCompany\IAirlineCompany;
use AirlinePassengerManifest\AirplaneType\IAirplaneType;
use AirlinePassengerManifest\Configuration;
use AirlinePassengerManifest\IPassenger;

class Aircraft
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

        $this->configuration = Configuration::getSeatConfiguration($airplaneType->getModel(), $company->getCarrierName());
    }

    public static function getInstance(IAirlineCompany $company, IAirplaneType $airplaneType) {
        $carrierName = $company->getCarrierName();
        $brand = $airplaneType->getBrand();
        if (self::$instances[$carrierName][$brand]) {
            return self::$instances[$carrierName][$brand];
        }

        $instances[$carrierName][$brand] = new self($company, $airplaneType);

        return $instances[$carrierName][$brand];
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
        return count($this->seats[$seatClass]);
    }

    public function getPassengerList() {
        $list = "";
        foreach ($this->seats as $class => $pasengers) {
            foreach ($pasengers as $seatNumber => $pasenger) {
                $_seatNumber = $seatNumber + 1;
                $list .= "Name: {$pasenger['name']}, Age: {$pasenger['age']},  
                    Gender: {$pasenger['gender']}, Seat: {$this->getClassName($class)} {$_seatNumber}";
            }
        }

        return $list;
    }

    public function addPassenger(IPassenger $passenger) {
        if (!$this->getAvailableSeats($passenger->getSeatClass())) {
            throw new \Exception('No Available seat');
        }

        if (empty($this->seats[$passenger->getSeatClass()])) {
            $this->seats[$passenger->getSeatClass()] = [];
        }

        $this->seats[$passenger->getSeatClass()][] = $passenger;

        return null;

    }
}
