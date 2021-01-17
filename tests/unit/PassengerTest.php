<?php


use AirlinePassengerManifest\Passenger;
use PHPUnit\Framework\TestCase;

class PassengerTest extends TestCase
{

    private $passenger;

    public function setUp() : void {
        $this->passenger = new Passenger('Joshua', 14, 'male');
    }

    public function testGetSeatClass()
    {

    }

    public function test__construct()
    {

    }

    public function testSetTicket()
    {

    }

    public function testCheckIn()
    {

    }

    public function testGetSeatNumber()
    {

    }

    public function testGetName()
    {
        $this->assertEquals('Joshua', $this->passenger->getName());
    }

    public function testGetAge() {
        $this->assertEquals(14, $this->passenger->getAge());
    }

    public function testGetGender() {
        $this->assertEquals('male', $this->passenger->getGender());
    }
}
