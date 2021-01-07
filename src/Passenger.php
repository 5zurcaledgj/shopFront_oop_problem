<?php

namespace AirlinePassengerManifest;

use AirlinePassengerManifest\Aircraft\Aircraft;
use AirlinePassengerManifest\Enum\Gender;
use AirlinePassengerManifest\Ticket\Ticket;
use Exception;

class Passenger

{
    private $name;
    private $age;
    private $gender;
    private $ticket;

    public function __construct($name, $age, $gender)
    {
        if (Gender::FEMALE != $gender && Gender::MALE != $gender) {
            throw new \Exception('Invalid Gender');
        }

        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
    }

    public function setTicket(array $ticket) {
        $this->ticket = new Ticket($ticket['seatNumber'], $ticket['class'], $ticket['brand'], $ticket['airlineCompany'],);
    }

    public function checkIn() {
        if (is_null($this->ticket)) {
            throw new Exception('Person has no ticket yet');
        }

        Aircraft::getInstance($this->ticket->getCompany(), $this->ticket->getBrand())->addPassenger($this);
    }
}
