<?php

namespace App\Http\Controllers\Api\Client\SelectionPost;

use App\Http\Controllers\Controller;
use App\Usecases\GetSelectionPostByFirebaseShopIdUsecase;
use Illuminate\Http\Request;

class IndexByFirebaseShopIdSelectionPostController extends Controller
{
    private GetSelectionPostByFirebaseShopIdUsecase $_getSelectionPostByFirebaseShopIdUsecase;

    public function __construct(
        GetSelectionPostByFirebaseShopIdUsecase $getSelectionPostByFirebaseShopIdUsecase
    ) {
        $this->_getSelectionPostByFirebaseShopIdUsecase = $getSelectionPostByFirebaseShopIdUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $firebaseShopId
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $firebaseShopId)
    {
        $selectionPosts = $this->_getSelectionPostByFirebaseShopIdUsecase->invoke($firebaseShopId);

        return response()->json($selectionPosts);
    }
}
