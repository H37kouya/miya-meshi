<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FirebaseKeywords
 *
 * @property int $id
 * @property string $keywordable_type
 * @property int $keywordable_id
 * @property string $firebase_keyword_id firebase keyword id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseKeywords newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseKeywords newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseKeywords query()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseKeywords whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseKeywords whereFirebaseKeywordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseKeywords whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseKeywords whereKeywordableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseKeywords whereKeywordableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseKeywords whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FirebaseKeywords extends Model
{
    //
}
