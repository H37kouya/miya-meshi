<?php

namespace App\Models;

use App\Enum\Models\ShopMenuModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\ShopMenu
 *
 * @property int $id
 * @property int $shop_id
 * @property int $release 公開設定
 * @property string|null $publish_from 公開開始日時
 * @property string|null $publish_to 公開終了日時
 * @property int $priority 優先度
 * @property string $name メニュー名
 * @property string|null $description メニュー概要
 * @property string|null $intro メニュー紹介文
 * @property int|null $price 値段
 * @property string|null $period_of_time 時間帯
 * @property int $is_tax_included 税込みかどうか
 * @property int $can_takeout テイクアウト可能かどうか
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Image|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu nowPublicPosts(\Illuminate\Support\Carbon $now)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu whereCanTakeout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu whereIsTaxIncluded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu wherePeriodOfTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu wherePublishFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu wherePublishTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu whereRelease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopMenu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShopMenu extends Model
{
    protected $fillable = [
        ShopMenuModel::shop_id,
        ShopMenuModel::release,
        ShopMenuModel::publish_from,
        ShopMenuModel::publish_to,
        ShopMenuModel::priority,
        ShopMenuModel::name,
        ShopMenuModel::description,
        ShopMenuModel::intro,
        ShopMenuModel::price,
        ShopMenuModel::period_of_time,
        ShopMenuModel::is_tax_included,
        ShopMenuModel::can_takeout,
    ];

    protected $casts = [
        ShopMenuModel::release         => 'boolean',
        ShopMenuModel::is_tax_included => 'boolean',
        ShopMenuModel::can_takeout     => 'boolean',
    ];

        /**
     * 現在公開中かどうか
     *
     * @param boolean $release
     * @param Carbon|null $publish_from
     * @param Carbon|null $publish_to
     * @param Carbon $now
     * @return boolean
     */
    public static function getNowPublic(
        bool $release,
        ?Carbon $publish_from,
        ?Carbon $publish_to,
        Carbon $now
    ): bool {
        if (!$release) {
            return false;
        }

        if ($publish_from === null && $publish_to === null) {
            return true;
        }

        if ($publish_from && $publish_from->lt($now) && $publish_to === null) {
            return true;
        }

        if ($publish_to && $publish_to->gt($now) && $publish_from === null) {
            return true;
        }

        if ($publish_to && $publish_to->gt($now) && $publish_to && $publish_from->lt($now)) {
            return true;
        }

        return false;
    }

    /**
     * 現在公開中かどうか
     *
     * @return boolean
     */
    public function getNowPublicAttibute(): bool
    {
        $now = Carbon::now();
        return self::getNowPublic(
            $this->release,
            $this->publish_from,
            $this->publish_to,
            $now
        );
    }

    /**
     * 現在公開中のものを取得する
     *
     * @param $query
     * @param Carbon $now
     * @return void
     */
    public function scopeNowPublicPosts($query, Carbon $now)
    {
        return $query->whereRelease(true)
            ->where(function ($query) use ($now) {
                $query->where(function ($query) use ($now) {
                    $query->where(ShopMenuModel::publish_from, '<', $now)->where(ShopMenuModel::publish_to, '>', $now);
                })
                ->orWhere(function($query) use($now) {
                    $query->where(ShopMenuModel::publish_from, '<', $now)->whereNull(ShopMenuModel::publish_to);
                })
                ->orWhere(function($query) use($now) {
                    $query->where(ShopMenuModel::publish_to, '>', $now)->whereNull(ShopMenuModel::publish_from);
                })
                ->orWhere(function($query) {
                    $query->whereNull(ShopMenuModel::publish_from)->whereNull(ShopMenuModel::publish_to);
                });
            });
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
