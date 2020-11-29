<?php

namespace App\Usecases;

use App\Repositories\CreateUserRepository;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateUserUsecase
{
    /**
     * Userを生成する
     */
    private CreateUserRepository $_createUserRepository;

    public function __construct(CreateUserRepository $createUserRepository)
    {
        $this->_createUserRepository = $createUserRepository;
    }

    /**
     * Userを生成する
     *
     * @param string $name
     * @return array
     */
    public function invoke(
        string $name
    ): array {
        DB::beginTransaction();
        try {
            $user = $this->_createUserRepository->invoke($name);
            DB::commit();
            Cache::flush();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e);
            throw $e;
        }
    }
}
