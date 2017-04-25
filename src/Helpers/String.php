<?php

namespace Noldors\CommerceMLParser\Helpers;

class Str
{
    /**
     * Get bool from value.
     *
     * @param $value
     *
     * @return bool|mixed
     */
    public static function toBool($value)
    {
        $key = mb_strtolower($value);

        $map = array(
            'true'   => true,
            '1'      => true,
            'on'     => true,
            'yes'    => true,
            'false'  => false,
            '0'      => false,
            'off'    => false,
            'no'     => false,
            'y'      => true,
            'n'      => false,
            'да'     => true,
            'нет'    => false,
            'правда' => true,
            'ложь'   => false
        );
        if (array_key_exists($key, $map)) {
            return $map[$key];
        } elseif (is_numeric($value)) {
            return (intval($value) > 0);
        }

        return (bool)trim($value);
    }
}