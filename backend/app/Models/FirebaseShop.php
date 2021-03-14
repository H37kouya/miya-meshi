<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FirebaseShop
 *
 * @property int $id
 * @property string $firebase_shop_id
 * @property int $shop_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseShop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseShop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseShop query()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseShop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseShop whereFirebaseShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseShop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseShop whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseShop whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FirebaseShop extends Model
{
    protected $fillable = [
        'shop_id',
        'firebase_shop_id'
    ];
}
