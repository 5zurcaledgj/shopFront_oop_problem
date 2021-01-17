<?php


use AirlinePassengerManifest\Aircraft\Aircraft;
use AirlinePassengerManifest\Ticket\Ticket;

class TicketTest extends \PHPUnit\Framework\TestCase
{
    private $ticket;

    public function setUp(): void {
        $this->ticket = new Ticket(1, 'First Class', 'Boeing', 'Qantas');
    }

    public function testGetAircraft()
    {
        $this->assertInstanceOf(Aircraft::class, $this->ticket->getAircraft());
    }

    public function testException()
    {
        $this->expectException(Exception::class);
    }

    public function testGetAirCraftInfo()
    {

    }

    public function testGetCompany()
    {
        $this->assertEquals('Qantas', $this->ticket->getCompany());
    }

    public function testGetBrand()
    {
        $this->assertEquals('Boeing', $this->ticket->getBrand());
    }

    public function testGetSeatClass()
    {
        $this->assertEquals('First Class', $this->ticket->getSeatClass());
    }

    public function testGetFlightNumber()
    {
        $this->assertEquals(1, $this->ticket->getFlightNumber());
    }
}
