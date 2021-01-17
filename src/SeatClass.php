<?php


namespace AirlinePassengerManifest;


use AirlinePassengerManifest\Collections\ICollectionItem;

class SeatClass implements ICollectionItem
{
    public function getName()
    {
        return $this->name;
    }
}
