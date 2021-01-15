<?php

namespace App\Models;

use App\Enum\Models\FirebaseDishModel;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FirebaseDishes
 *
 * @property int $id
 * @property string $dishable_type
 * @property int $dishable_id
 * @property string $firebase_dish_id firebase dish id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseDishes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseDishes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseDishes query()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseDishes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseDishes whereDishableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseDishes whereDishableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseDishes whereFirebaseDishId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseDishes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseDishes whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FirebaseDishes extends Model
{
    protected $fillable = [
        FirebaseDishModel::firebase_dish_id,
    ];
}
