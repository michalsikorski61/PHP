<?php

namespace Core;
class Validator{
    public static function string($value,$min = 3, $max = INF){
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }


    public static function email($value){
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function greaterThan(string $value, int $greaterThen): bool{
        return $value > $greaterThen;
    }
}