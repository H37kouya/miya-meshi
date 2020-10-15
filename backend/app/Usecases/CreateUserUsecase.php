<?php

namespace App\Usecases;

use App\Repositories\CreateUserRepository;

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
        return $this->_createUserRepository->invoke($name);
    }
}
