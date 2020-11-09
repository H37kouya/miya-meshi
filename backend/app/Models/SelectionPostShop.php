<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelectionPostShop extends Model
{
    protected $fillable = [
        'selection_post_id',
        'firebase_shop_id'
    ];
}
