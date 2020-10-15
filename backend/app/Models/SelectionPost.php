<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 */
class SelectionPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'contents',
        'release'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Relation to SelectionPostArea
     *
     * @return HasMany
     */
    public function selectionPostAreas(): HasMany
    {
        return $this->hasMany(SelectionPostArea::class);
    }
}
