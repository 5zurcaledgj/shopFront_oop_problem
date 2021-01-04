<?php


namespace Plane\Factories;


abstract class FactoryAbstract
{
    public function __construct($name)
    {
        $this->name = $name;
    }

}
