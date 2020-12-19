<?php

namespace App\Http\Requests\Traits;

use App\Support\Arr;
use Illuminate\Support\Str;

trait JsonRequest
{
    /**
     * Get all of the input and files for the request.
     * keyをキャメルケースにして取得する
     *
     * @param  array $keys
     * @return array
     */
    public function allToSnakeKeysByCamelKeys(array $keys = [])
    {
        return Arr::snake_keys($this->all(Arr::camel_keys($keys)));
    }

    /**
     * keyをキャメルケースにして取得する
     *
     * @param  array $keys
     * @return array
     */
    public function exceptToSnakeKeysByCamelKeys(array $keys = [])
    {
        return Arr::snake_keys($this->except(Arr::camel_keys($keys)));
    }

    /**
     * keyをキャメルケースにして取得する
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function getByCamelKey(string $key, $default = null)
    {
        return $this->get(Str::camel($key), $default);
    }
}
