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

    private const test_arrs_snake = [
        [1, 2, 3, 4, 5, 6],
        ["one_one" => 1, "two_two" => 2, "three_three" => 3, "four_four" => 4, "five_five" => 5, "six_six" => 6],
    ];
    private const proper_arrs_snake = [
        [1, 2, 3, 4, 5, 6],
        ["oneOne" => 1, "twoTwo" => 2, "threeThree" => 3, "fourFour" => 4, "fiveFive" => 5, "sixSix" => 6],
    ];
    private const test_arrs_camel = [
        [1, 2, 3, 4, 5, 6],
        ["oneOne" => 1, "twoTwo" => 2, "threeThree" => 3, "fourFour" => 4, "fiveFive" => 5, "sixSix" => 6],
    ];
    private const proper_arrs_camel = [
        [1, 2, 3, 4, 5, 6],
        ["one_one" => 1, "two_two" => 2, "three_three" => 3, "four_four" => 4, "five_five" => 5, "six_six" => 6],
    ];
    public static function testArr()
    {
        foreach (self::test_arrs_snake as $test_arr) {
            $cameled[] = Arr::camel_keys($test_arr); //テストすべき配列のキーをキャメル化する
        }
        foreach ($cameled as $arr) {
            static $i = 0;
            $j = 0;
            $keys = array_keys($arr); //配列をひとつづつキーだけ取り出す
            foreach ($keys as $value) {
                self::assertEquals($value, array_keys(self::proper_arrs_snake[$i])[$j]);
                $j++;
            }
            $i++;
        } //ここまでがcamel_keysのテスト
        // ここからsnake_keysのテスト
        foreach (self::test_arrs_camel as $test_arr) {
            $snaked[] = Arr::snake_keys($test_arr); //テストすべき配列のキーをスネーク化する
        }
        foreach ($snaked as $arr) {
            static $k = 0;
            $l = 0;
            $keys = array_keys($arr); //配列をひとつづつキーだけ取り出す
            foreach ($keys as $value) {
                self::assertEquals($value, array_keys(self::proper_arrs_camel[$k])[$l]);
                $l++;
            }
            $k++;
        }
    }
}
