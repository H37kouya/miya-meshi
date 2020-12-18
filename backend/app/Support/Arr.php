<?php

namespace App\Support;

use Illuminate\Support\Arr as ArrSupport;
use Illuminate\Support\Str;

class Arr extends ArrSupport
{
    /**
     * key名をキャメルケースに変更
     *
     * @param array $array
     * @return array
     */
    public static function camel_keys(array $array): array
    {
        $results = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $results[Str::camel($key)] = static::camel_keys($value);
            } else {
                $results[Str::camel($key)] = $value;
            }
        }
        return $results;
    }
}
