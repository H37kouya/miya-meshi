<?php

namespace App\Enum;

class PeriodOfTime
{
    /**
     * 朝
     */
    public const MORNING = 'MORNING';

    /**
     * 昼
     */
    public const LUNCH = 'LUNCH';

    /**
     * 夜
     */
    public const NIGHT = 'NIGHT';

    /**
     * 朝と昼
     */
    public const MORNING_AND_LUNCH = 'MORNING_AND_LUNCH';

    /**
     * 昼と夜
     */
    public const LUNCH_AND_NIGHT = 'LUNCH_AND_NIGHT';

    /**
     * 朝と昼と夜
     */
    public const MORNING_AND_LUNCH_AND_NIGHT = 'MORNING_AND_LUNCH_AND_NIGHT';

    /**
     * 24h
     */
    public const ALL_TIME = 'ALL_TIME';

    // 引数$arrはフロントからの入力値。ex.:$arr=["MORNING","LUNCH"]:MORNING_AND_LUNCH
    //DB入力に際して配列で受けた入力値を，文字列にする関数である
    public static function arr_to_string(array $arr): string
    {
        $isMorning = in_array(self::MORNING, $arr);
        $isLunch = in_array(self::LUNCH, $arr);
        $isNight = in_array(self::NIGHT, $arr);
        $isAllTime = in_array(self::ALL_TIME, $arr);

        if ($isAllTime) {
            return self::ALL_TIME;
        }

        if ($isMorning && $isLunch && $isNight) {
            return self::MORNING_AND_LUNCH_AND_NIGHT;
        }

        if ($isMorning && $isLunch) {
            return self::MORNING_AND_LUNCH;
        }

        if ($isLunch && $isNight) {
            return self::LUNCH_AND_NIGHT;
        }

        if ($isMorning || $isLunch || $isNight) {
            return $arr[0];
        }

        return null;
    }
}
