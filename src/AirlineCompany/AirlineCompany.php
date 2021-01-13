<?php

namespace AirlinePassengerManifest\AirlineCompany;

class AirlineCompany implements IAirlineCompany
{
    private $headquarters;
    private $carrierName;

    public function __construct($carrierName, $headquarters)
    {
        $this
            ->setHeadquarters($headquarters)
            ->setCarrierName($carrierName);
    }

    /**
     * @param mixed $carrierName
     * @return AirlineCompany
     */
    public function setCarrierName($carrierName)
    {
        $this->carrierName = $carrierName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCarrierName()
    {
        return $this->carrierName;
    }

    /**
     * @return null
     */
    public function getHeadquarters()
    {
        return $this->headquarters;
    }

    /**
     * @param null $headquarters
     * @return AirlineCompany
     */
    public function setHeadquarters($headquarters)
    {
        $this->headquarters = $headquarters;
        return $this;
    }


}
