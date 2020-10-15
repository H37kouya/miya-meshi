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
        try {
            DB::beginTransaction();

            /** @var User $user */
            $user = $this->_user->create([
                'name'           => $name,
                'token'          => $this->_user->createToken(),
                'remember_token' => $this->_user->createRememberToken(),
                'active'         => true
            ]);

            DB::commit();

            return [
                'name'  => $user->name,
                'token' => $user->token
            ];
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
