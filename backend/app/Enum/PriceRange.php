<?php

namespace App\Enum;

/**
 * 価格帯
 */
class PriceRange
{
    /**
     * ~ 500円
     */
    public const UNDER_500 = 'UNDER_500';

    /**
     * 500円 ~ 1000円
     */
    public const BETWEEN_500_AND_1000 = 'BETWEEN_500_AND_1000';

    /**
     * 1000円 ~ 2000円
     */
    public const BETWEEN_1000_AND_2000 = 'BETWEEN_1000_AND_2000';

    /**
     * 2000円 ~ 3000円
     */
    public const BETWEEN_2000_AND_3000 = 'BETWEEN_2000_AND_3000';

    /**
     * 3000円 ~ 5000円
     */
    public const BETWEEN_3000_AND_5000 = 'BETWEEN_3000_AND_5000';

    /**
     * 5000円 ~ 10000円
     */
    public const BETWEEN_5000_AND_10000 = 'BETWEEN_5000_AND_10000';

    /**
     * 10000円 ~
     */
    public const OVER_10000 = 'OVER_10000';

    public static function getAll(): array
    {
        return [
            self::UNDER_500,
            self::BETWEEN_1000_AND_2000,
            self::BETWEEN_2000_AND_3000,
            self::BETWEEN_3000_AND_5000,
            self::BETWEEN_5000_AND_10000,
            self::OVER_10000,
        ]
    }
}
