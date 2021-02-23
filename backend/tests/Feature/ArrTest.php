<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArrTest extends TestCase
{
    /**
     * Test whether Arr.php works properly
     *
     * @return void
     */

    private $test_arr = [
        [1, 2, 3, 4, 5, 6],
        ["one_one" => 1, "two_two" => 2, "three_three" => 3, "four_four" => 4, "five_five" => 5, "six_six" => 6]
    ];
    public function testArr()
    {
        Arr:
    }
}
