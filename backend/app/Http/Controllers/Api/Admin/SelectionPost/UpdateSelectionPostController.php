<?php

namespace App\Http\Controllers\Api\Admin\SelectionPost;

use App\Http\Controllers\Controller;
use App\Usecases\UpdateSelectionPostUsecase;
use Illuminate\Http\Request;

class UpdateSelectionPostController extends Controller
{
    private UpdateSelectionPostUsecase $_updateSelectionPostUsecase;

    public function __construct(UpdateSelectionPostUsecase $updateSelectionPostUsecase)
    {
        $this->_updateSelectionPostUsecase = $updateSelectionPostUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, int $selectionPostId)
    {
        $selectionPost = $this->_updateSelectionPostUsecase->invoke(
            $selectionPostId,
            $request->all()
        );

        return response()->json([
            'data' => $selectionPost
        ]);
    }
}
