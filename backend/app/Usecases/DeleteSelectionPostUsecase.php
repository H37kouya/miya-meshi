<?php

namespace App\Usecases;

use App\Repositories\DeleteSelectionPostRepository;

class DeleteSelectionPostUsecase
{
    private DeleteSelectionPostRepository $_deleteSelectionPostRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(DeleteSelectionPostRepository $deleteSelectionPostRepository)
    {
        $this->_deleteSelectionPostRepository = $deleteSelectionPostRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(int $id)
    {
        $this->_deleteSelectionPostRepository->invoke($id);
    }
}
