<?php


namespace AirlinePassengerManifest\Enum;


class AirplaneTypes extends EnumAbstract
{
    const BOEING = 'Boeing';
    const AIRBUS = 'Airbus';
    const DASH = 'Dash';

    public function getModel($type) {
        $models = [
            self::BOEING => '737-800',
            self::AIRBUS => 'A380',
            self::DASH => '8',
        ];

        return $type;
    }

    public function getAll()
    {
        return [self::BOEING, self::AIRBUS, self::DASH];
    }
}
