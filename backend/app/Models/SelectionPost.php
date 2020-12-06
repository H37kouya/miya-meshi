<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\SelectionPost
 *
 * @property int $id
 * @property string $title タイトル
 * @property string|null $description 一言コメント
 * @property string|null $contents メインコンテンツ
 * @property int $release 公開設定
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SelectionPostArea[] $selectionPostAreas
 * @property-read int|null $selection_post_area_count
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost newQuery()
 * @method static \Illuminate\Database\Query\Builder|SelectionPost onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|SelectionPost withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SelectionPost withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $image サムネイル画像
 * @property-read int|null $selection_post_areas_count
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost whereRelease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPost whereTitle($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SelectionPostShop[] $selectionPostShops
 * @property-read int|null $selection_post_shops_count
 */
class SelectionPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'contents',
        'content_mode',
        'link',
        'image',
        'release',
        'publish_from',
        'publish_to'
    ];

    protected $dates = ['deleted_at', 'publish_from', 'publish_to'];

    protected $casts = [
        'release' => 'boolean'
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
                    $query->where('publish_from', '<', $now)->where('publish_to', '>', $now);
                })
                ->orWhere(function($query) use($now) {
                    $query->where('publish_from', '<', $now)->whereNull('publish_to');
                })
                ->orWhere(function($query) use($now) {
                    $query->where('publish_to', '>', $now)->whereNull('publish_from');
                })
                ->orWhere(function($query) {
                    $query->whereNull('publish_from')->whereNull('publish_to');
                });
            });
    }

    /**
     * Relation to SelectionPostArea
     *
     * @return HasMany
     */
    public function selectionPostAreas(): HasMany
    {
        return $this->hasMany(SelectionPostArea::class);
    }

    /**
     * Relation to SelectionPostShop
     *
     * @return HasMany
     */
    public function selectionPostShops(): HasMany
    {
        return $this->hasMany(SelectionPostShop::class);
    }
}
