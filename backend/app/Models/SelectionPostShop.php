<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SelectionPostShop
 *
 * @property int $id
 * @property int $selection_post_id
 * @property string $firebase_shop_id firebase shop id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostShop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostShop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostShop query()
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostShop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostShop whereFirebaseShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostShop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostShop whereSelectionPostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostShop whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SelectionPostShop extends Model
{
    protected $fillable = [
        'selection_post_id',
        'firebase_shop_id'
    ];
}
