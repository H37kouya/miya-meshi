<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SelectionPostArea
 *
 * @property int $id
 * @property int $selection_post_id
 * @property string $firebase_area_id firebase area id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostArea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostArea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostArea query()
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostArea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostArea whereFirebaseAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostArea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostArea whereSelectionPostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SelectionPostArea whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SelectionPostArea extends Model
{
    protected $fillable = [
        'selection_post_id',
        'firebase_area_id'
    ];
}
