<?php

namespace App\Helpers;

class HelpersBasic
{
    public function __construct()
    {
    }

    public static function color_array($count)
    {
        $color_array = config('core_settings.colors');
        $color_count = (int)count($color_array);

        $colors = [];
        $y = 0;

        for ($i=0; $i<$count; $i++) {
            if ($y >= ($color_count - 1)) {
                $y = 0;
            } else {
                $y++;
            }
            $colors[] = $color_array[$y];
        }

        return $colors;
    }

    public static function array_diff_once($array1, $array2)
    {
        foreach ($array2 as $a) {
            $pos = array_search($a, $array1);
            if ($pos !== false) {
                unset($array1[$pos]);
            }
        }

        return $array1;
    }

    public static function quartile($collection, $q)
    {
        $array = $collection->toArray();
        sort($array);
        $count = count($array);
        $middleval = floor(($count-1)* $q);
        if ($count % 2) {
            $quartile = $array[$middleval];
        } else {
            $low = $array[$middleval];
            $high = $array[$middleval+1];
            $quartile = (($low+$high)/2);
        }

        return $quartile;
    }

    public function UpperCaseAfterSigns($string)
    {
        $signs = ['-', "'", ' ', '"', '.'];
        $string = trim(mb_strtolower($string, 'UTF-8'));
        foreach ($signs as $sign) {
            $string = implode($sign, array_map('ucfirst', explode($sign, $string)));
        }

        return $string;
    }

    public function stripAccents($str)
    {
        return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }

    public static function division($a, $b)
    {
        if ($b === 0) {
            return 0;
        }

        return $a / $b;
    }
}
