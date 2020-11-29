<?php

namespace App\Http\Controllers\Api\Client\SelectionPost;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\SelectionPost\IndexSelectionPostFormRequest;
use App\Usecases\PaginateSelectionPostUsecase;

class IndexSelectionPostController extends Controller
{
    private PaginateSelectionPostUsecase $_paginateSelectionPostUsecase;

    public function __construct(PaginateSelectionPostUsecase $paginateSelectionPostUsecase)
    {
        $this->_paginateSelectionPostUsecase = $paginateSelectionPostUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(IndexSelectionPostFormRequest $request)
    {
        $serach = [
            'releases'   => [true],
            'limit'      => $request->query('limit', 10),
            'id'         => $request->query('id', null),
            'created_at' => $request->query('created_at', null),
            'updated_at' => $request->query('updated_at', null),
        ];

        $paginateSelectionPost = $this->_paginateSelectionPostUsecase->invoke($serach);

        return response()->json($paginateSelectionPost);
    }
}
