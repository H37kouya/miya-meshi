<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Usecases\UpdateShopUsecase;
use Illuminate\Http\Request;

class UpdateShopController extends Controller
{
    private UpdateShopUsecase $_updateShopUsecase;

    public function __construct(UpdateShopUsecase $updateShopUsecase)
    {
        $this->_updateShopUsecase = $updateShopUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $shopId)
    {
        $shop = $this->_updateShopUsecase->invoke($shopId, $request->all());

        return response()->json([
            'data' => $shop
        ]);
    }
}
