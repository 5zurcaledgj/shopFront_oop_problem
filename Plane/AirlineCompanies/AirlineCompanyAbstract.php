<?php

namespace Plane\AirlineCompanies;

abstract class AirlineCompanyAbstract
{
    private $headquarters;
    private $carrierName;

    /**
     * @param mixed $carrierName
     * @return AirlineCompanyAbstract
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
     * @return AirlineCompanyAbstract
     */
    public function setHeadquarters($headquarters)
    {
        $this->headquarters = $headquarters;
        return $this;
    }


}
