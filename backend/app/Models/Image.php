<?php

namespace App\Models;

use App\Enum\Models\ImageModel;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        ImageModel::url,
        ImageModel::imageable_name,
    ];
}
