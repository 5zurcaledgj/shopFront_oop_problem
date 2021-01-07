<?php

namespace AirlinePassengerManifest\Aircraft;

use AirlinePassengerManifest\Factories\AirlineCompanyFactory;
use AirlinePassengerManifest\Factories\AirplaneTypeFactory;

class Aircraft
{
    private static $instances = [];
    private $company;
    private $airplaneType;

    private function __construct($company, $airplaneType)
    {
        $this->airplaneType = AirplaneTypeFactory::create($airplaneType);
        $this->company = AirlineCompanyFactory::create($company);
    }

    public static function getInstance($company, $airplaneType) {
        if (self::$instances[$company][$airplaneType]) {
            return self::$instances[$company][$airplaneType];
        }

        $instances[$company][$airplaneType] = new self($company, $airplaneType);

        return $instances[$company][$airplaneType];
    }

    public function getSeats() {
        return array_reduce(array_keys($this->seats), function($partialTotal, $class) {
            $partialTotal += $this->getSeat($class);
            return $partialTotal;
        }, 0);
    }

    public function getAvailableSeats() {
        return array_reduce(array_keys($this->seats), function($partialTotal, $class) {
            $partialTotal += $this->getAvailable($class);
            return $partialTotal;
        }, 0);
    }

    public function getOccupiedSeats() {
        return array_reduce(array_keys($this->seats), function($partialTotal, $class) {
            $partialTotal += $this->getOccupied($class);
            return $partialTotal;
        }, 0);
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
}
