<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name ユーザー名
 * @property string $token トークン
 * @property string $remember_token Remember Token
 * @property int $active 有効なアカウントかどうか
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Model
{
    protected $fillable = [
        'name',
        'api_token',
        'remember_token',
        'active'
    ];

    /**
     * Remember Token生成
     *
     * @return string
     */
    public function createRememberToken(): string
    {
        $uuid = (string) Str::uuid();
        return base64_encode($uuid);
    }

    /**
     * API tokenの生成
     *
     * @return string
     */
    public function createApiToken(): string
    {
        return Str::random(80);
    }
}
