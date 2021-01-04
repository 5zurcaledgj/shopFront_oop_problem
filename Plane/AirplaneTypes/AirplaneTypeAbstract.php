<?php

namespace Plane\AirplaneTypes;

abstract class AirplaneTypeAbstract
{
    private $model;
    private $brand;
    private $firstClass = 0;
    private $business = 0;
    private $premiumEconomy = 0;
    private $economySeats = 0;

    /**
     * @param mixed $brand
     * @return AirplaneTypeAbstract
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @param int $firstClass
     * @return AirplaneTypeAbstract
     */
    public function setFirstClass($firstClass)
    {
        $this->firstClass = $firstClass;
        return $this;
    }

    /**
     * @param int $business
     * @return AirplaneTypeAbstract
     */
    public function setBusiness($business)
    {
        $this->business = $business;
        return $this;
    }

    /**
     * @param int $premiumEconomy
     * @return AirplaneTypeAbstract
     */
    public function setPremiumEconomy($premiumEconomy)
    {
        $this->premiumEconomy = $premiumEconomy;
        return $this;
    }

    /**
     * @param int $economySeats
     * @return AirplaneTypeAbstract
     */
    public function setEconomySeats($economySeats)
    {
        $this->economySeats = $economySeats;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return int
     */
    public function getFirstClass()
    {
        return $this->firstClass;
    }

    /**
     * @return int
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * @return int
     */
    public function getPremiumEconomy()
    {
        return $this->premiumEconomy;
    }

    /**
     * @return int
     */
    public function getEconomySeats()
    {
        return $this->economySeats;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     * @return AirplaneTypeAbstract
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }


}
