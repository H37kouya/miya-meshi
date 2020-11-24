<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateUserRepository
{
    private User $_user;

    public function __construct(User $user)
    {
        $this->_user = $user;
    }

    public function invoke(string $name): array
    {
        /** @var User $user */
        $user = $this->_user->create([
            'name'           => $name,
            'api_token'      => $this->_user->createApiToken(),
            'remember_token' => $this->_user->createRememberToken(),
            'active'         => true
        ]);

        return [
            'name'      => $user->name,
            'api_token' => $user->api_token
        ];
    }
}
