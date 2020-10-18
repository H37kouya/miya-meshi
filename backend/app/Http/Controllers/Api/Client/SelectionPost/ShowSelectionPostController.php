<?php

namespace App\Http\Controllers\Api\Client\SelectionPost;

use App\Http\Controllers\Controller;
use App\Usecases\GetSelectionPostUsecase;
use Illuminate\Http\Request;

class ShowSelectionPostController extends Controller
{
    private GetSelectionPostUsecase $_getSelectionPostUsecase;

    public function __construct(GetSelectionPostUsecase $getSelectionPostUsecase)
    {
        $this->_getSelectionPostUsecase = $getSelectionPostUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $selectionPostId)
    {
        return $this->_getSelectionPostUsecase->invoke($selectionPostId);
    }
}
