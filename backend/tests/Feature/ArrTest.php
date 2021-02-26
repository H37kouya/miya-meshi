<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Support\Arr;

class ArrTest extends TestCase
{
    /**
     * Test whether Arr.php works properly
     *
     * @return void
     */
    public function testCamelKeys()
    {
        // GIVEN - 前準備
        $testCase = [
            "one_one"     => 1,
            "two_two"     => 2,
            "three_three" => 3,
            "four_four"   => 4,
            "five_five"   => 5,
            "six_six"     => 6,
        ];
        $expected = [
            "oneOne" => 1,
            "twoTwo" => 2,
            "threeThree" => 3,
            "fourFour" => 4,
            "fiveFive" => 5,
            "sixSix" => 6,
        ];

        // WHEN - テスト関数の実行
        $actual = Arr::camel_keys($testCase);

        // THEN - 結果の確認
        $this->assertEquals($expected, $actual);
    }

    public function testArr()
    {
        // GIVEN - 前準備

        // WHEN - テスト関数の実行

        // THEN - 結果の確認
    }
}
