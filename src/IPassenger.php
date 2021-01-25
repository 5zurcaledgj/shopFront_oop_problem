<?php


namespace AirlinePassengerManifest;

use AirlinePassengerManifest\Collections\ICollectionItem;

interface IPassenger extends ICollectionItem
{
    public function getSeatClass();
    public function getSeatNumber();
    public function getAge();
    public function getSex();
}
