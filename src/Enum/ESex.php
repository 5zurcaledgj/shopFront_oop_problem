<?php

namespace AirlinePassengerManifest\Enum;

class ESex
{
    const MALE = 'male';
    const FEMALE = 'female';

    public static function getName($sex) {
        if (self::MALE == $sex) {
            return 'Male';
        }

        if (self::FEMALE == $sex) {
            return 'Female';
        }

        throw new \Exception('Invalid ESex');
    }
}


