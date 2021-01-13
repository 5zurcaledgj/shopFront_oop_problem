<?php

namespace AirlinePassengerManifest\AirplaneType;

class AirplaneType implements IAirplaneType
{
    private $model;
    private $brand;

    public function __construct($model, $brand)
    {
        $this
            ->setBrand($brand)
            ->setModel($model);
    }

    /**
     * @param mixed $brand
     * @return AirplaneType
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
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
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     * @return AirplaneType
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }


}
