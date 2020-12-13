<?php

namespace App\Models;

use App\Enum\Models\ShopModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Shop
 *
 * @property int $id
 * @property bool $release 公開設定
 * @property Carbon|null $publish_from 公開開始日時
 * @property Carbon|null $publish_to 公開終了日時
 * @property string $display_mode 表示モード
 * @property int $priority 優先度
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\FirebaseShop|null $firebaseShop
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\ShopInformation|null $shopInformation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ShopMenu[] $shopMenus
 * @property-read int|null $shop_menus_count
 * @method static \Illuminate\Database\Eloquent\Builder|Shop appearanceImageLink()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop imageLink()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop menuImageLink()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop nowPublicPosts(\Illuminate\Support\Carbon $now)
 * @method static \Illuminate\Database\Query\Builder|Shop onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop query()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop subImageLink()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereDisplayMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop wherePublishFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop wherePublishTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereRelease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Shop withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Shop withoutTrashed()
 * @mixin \Eloquent
 */
class Shop extends Model
{
    use SoftDeletes;

    protected $fillable = [
        ShopModel::release,
        ShopModel::publish_from,
        ShopModel::publish_to,
        ShopModel::priority,
        ShopModel::display_mode
    ];

    protected $dates = [
        ShopModel::deleted_at,
        ShopModel::publish_from,
        ShopModel::publish_to,
    ];

    protected $casts = [
        ShopModel::priority => 'integer',
        ShopModel::release  => 'boolean'
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
                    $query->where(ShopModel::publish_from, '<', $now)->where(ShopModel::publish_to, '>', $now);
                })
                ->orWhere(function($query) use($now) {
                    $query->where(ShopModel::publish_from, '<', $now)->whereNull(ShopModel::publish_to);
                })
                ->orWhere(function($query) use($now) {
                    $query->where(ShopModel::publish_to, '>', $now)->whereNull(ShopModel::publish_from);
                })
                ->orWhere(function($query) {
                    $query->whereNull(ShopModel::publish_from)->whereNull(ShopModel::publish_to);
                });
            });
    }

    public function shopInformation(): HasOne
    {
        return $this->hasOne(ShopInformation::class);
    }

    public function shopMenus(): HasMany
    {
        return $this->hasMany(ShopMenu::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopeImageLink($query)
    {
        $query->images->whereImageableName(ShopModel::image_link);
    }

    public function scopeSubImageLink($query)
    {
        $query->images->whereImageableName(ShopModel::sub_image_link);
    }

    public function scopeMenuImageLink($query)
    {
        $query->images->whereImageableName(ShopModel::menu_image_link);
    }

    public function scopeAppearanceImageLink($query)
    {
        $query->images->whereImageableName(ShopModel::appearance_image_link);
    }

    public function firebaseShop(): HasOne
    {
        return $this->hasOne(FirebaseShop::class);
    }
}
