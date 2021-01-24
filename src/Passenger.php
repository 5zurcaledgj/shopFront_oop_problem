<?php

namespace AirlinePassengerManifest;

use AirlinePassengerManifest\Aircraft\Aircraft;
use AirlinePassengerManifest\Enum\Sex;
use AirlinePassengerManifest\Ticket\ITicket;
use Exception;

class Passenger implements IPassenger
{
    private $name;
    private $age;
    private $sex;
    private $ticket;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return mixed
     */
    public function getTicket() : ITicket
    {
        return $this->ticket;
    }


    public function __construct($name, $age, $sex)
    {
        if (Sex::FEMALE != $sex && Sex::MALE != $sex) {
            throw new \Exception('Invalid Sex');
        }

        $this->name = $name;
        $this->age = $age;
        $this->sex = $sex;
    }

    public function setTicket(ITicket $ticket) {
        $this->ticket = $ticket;
        return $this;
    }

    public function checkIn() {
        if (is_null($this->ticket)) {
            throw new Exception('Person has no ticket yet');
        }

        Aircraft::getInstance($this->ticket->getAirlineCompany(), $this->ticket->getAirplaneType())
            ->addPassenger($this);
    }

    public function getSeatClass()
    {
        return $this->ticket->getSeatClass();
    }

    public function getSeatNumber()
    {
        // TODO: Implement getSeatNumber() method.
    }
}
