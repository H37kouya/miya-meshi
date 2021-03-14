<?php

namespace App\Enum;

class importFirebasePeriodOfTime extends PeriodOfTime
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
    public static function arr_to_string(array $arr): ?string
    {
        $isMorning = in_array("朝", $arr);
        $isLunch = in_array("昼", $arr);
        $isNight = in_array("夜", $arr);

        if ($isMorning && $isLunch && $isNight) {
            return self::MORNING_AND_LUNCH_AND_NIGHT;
        }

        if ($isMorning && $isLunch) {
            return self::MORNING_AND_LUNCH;
        }

        if ($isLunch && $isNight) {
            return self::LUNCH_AND_NIGHT;
        }

        if ($isMorning) {
            return self::MORNING;
        }
        if ($isLunch) {
            return self::LUNCH;
        }
        if ($isNight) {
            return self::NIGHT;
        }

        return null;
    }
}
