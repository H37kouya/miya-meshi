<?php

namespace App\Http\Controllers\Api\Admin\SelectionPost;

use App\Http\Controllers\Controller;
use App\Usecases\DeleteSelectionPostUsecase;
use Illuminate\Http\Request;

class DeleteSelectionPostController extends Controller
{
    private DeleteSelectionPostUsecase $_deleteSelectionPostUsecase;

    public function __construct(DeleteSelectionPostUsecase $deleteSelectionPostUsecase)
    {
        $this->_deleteSelectionPostUsecase = $deleteSelectionPostUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $selectionPostId)
    {
        $this->_deleteSelectionPostUsecase->invoke($selectionPostId);
    }
}
