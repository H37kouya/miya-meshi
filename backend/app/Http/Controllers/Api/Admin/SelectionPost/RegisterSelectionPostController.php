<?php

namespace App\Http\Controllers\Api\Admin\SelectionPost;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\SelectionPost\RegisterSelectionPostFormRequest;
use App\Usecases\CreateSelectionPostUsecase;
use Illuminate\Http\Request;

class RegisterSelectionPostController extends Controller
{
    private CreateSelectionPostUsecase $_createSelectionPostUsecase;

    public function __construct(CreateSelectionPostUsecase $createSelectionPostUsecase)
    {
        $this->_createSelectionPostUsecase = $createSelectionPostUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterSelectionPostFormRequest $request)
    {
        $selectionPost = $this->_createSelectionPostUsecase->invoke($request->all());

        return response()->json([
            'data' => $selectionPost
        ]);
    }
}
