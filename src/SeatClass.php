<?php


namespace AirlinePassengerManifest;


use AirlinePassengerManifest\Collections\ICollectionItem;
use AirlinePassengerManifest\Collections\PassengerCollection;

class SeatClass implements ICollectionItem
{
    private $name;
    private $classIndex;
    /**
     * @var PassengerCollection
     */
    private $pasengers;

    /**
     * @return mixed
     */
    public function getClassIndex()
    {
        return $this->classIndex;
    }

    public function __construct($name, $classIndex)
    {
        $this->name = $name;
        $this->classIndex = $classIndex;
        $this->pasengers = new PassengerCollection([]);
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function getNumberOfPassengers() {
        return $this->pasengers->count();
    }

    public function addPassenger(IPassenger $passenger) {
        $this->pasengers->add($passenger);

        return $this->pasengers->get($passenger->getName());
    }

    public function getPassenger(IPassenger $passenger) {
        return $this->pasengers->get($passenger->getName());
    }
}
