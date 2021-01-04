<?php

namespace Plane;

use Plane\Factories\AirlineCompanyFactoryInterface;
use Plane\Factories\AirplaneTypeFactory;
use Plane\Factories\FactoryInterface;

class Plane
{
    private $flightNumber;
    private $destination;
    private $company;
    private $airplane;
    private $seats;

    const FIRST_CLASS_INDEX = 0;
    const BUSINESS_INDEX = 1;
    const PREMIUM_ECONOMY_INDEX = 2;
    const ECONOMY_INDEX = 3;

    private $function_map = [
        self::FIRST_CLASS_INDEX => 'getFirstClass',
        self::BUSINESS_INDEX => 'getBusiness',
        self::PREMIUM_ECONOMY_INDEX => 'getPremiumEconomy',
        self::ECONOMY_INDEX => 'getEconomySeats',
    ];


    public function __construct(FactoryInterface $company, FactoryInterface $airplane) {
        $this->company = $company->create();
        $this->airplane = $airplane->create();

        $this->seats = [
            self::FIRST_CLASS_INDEX => [],
            self::BUSINESS_INDEX => [],
            self::PREMIUM_ECONOMY_INDEX => [],
            self::ECONOMY_INDEX => [],
        ];
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
     * @return Plane
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
     * @return Plane
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * @param mixed $terminal
     * @return Plane
     */
    public function setTerminal($terminal)
    {
        $this->terminal = $terminal;
        return $this;
    }
    private $terminal;



    public function checkInPassenger($firstName, $lastName, $age, $gender) {
        $passenger = [
            'name' => "{$firstName} {$lastName}",
            'age' => $age,
            'gender' => $gender
        ];


        if ($this->isAvailable(self::FIRST_CLASS_INDEX)) {
            return $this->__checkInPassenger(self::FIRST_CLASS_INDEX, $passenger);
        }

        if ($this->isAvailable(self::BUSINESS_INDEX)) {
            return $this->__checkInPassenger(self::FIRST_CLASS_INDEX, $passenger);
        }

        if ($this->isAvailable(self::PREMIUM_ECONOMY_INDEX)) {
            return $this->__checkInPassenger(self::FIRST_CLASS_INDEX, $passenger);
        }

        if ($this->isAvailable(self::ECONOMY_INDEX)) {
            return $this->__checkInPassenger(self::FIRST_CLASS_INDEX, $passenger);
        }

    }


    private function isAvailable($class) {
        return  $this->getAvailable($class) > 0;
    }

    private function getAvailable($class) {
        return $this->getSeat($class) - $this->getOccupied($class);
    }

    private function getOccupied($class) {
        return count($this->seats[$class]);
    }

    private function getSeat($class) {
        return $this->airplane->{$this->function_map[$class]}();
    }

    private function __checkInPassenger($class, $passenger) {
        $this->seats[$class][] = $passenger;

        return null;
    }

    private function assignSeat() {

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

    public function getClassName($class) {
        switch ($class) {
            case self::FIRST_CLASS_INDEX:
                $name = 'First Class';
                break;
            case self::PREMIUM_ECONOMY_INDEX:
                $name = 'Premium Economy';
                break;
            case self::BUSINESS_INDEX_INDEX:
                $name = 'Business';
                break;
            case self::ECONOMY_INDEX:
                $name = 'Economy';
                break;
            default:
                $name = '';
        }

        return $name;
    }



    public function getBrand() {
        return $this->airplane->getBrand();
    }

    public function getModel() {
        return $this->airplane->getModel();
    }

    public function getCarrierName() {
        return $this->company->getCarrierName();
    }

    public function getHeadquarters() {
        return $this->company->getHeadquarters();
    }
}
