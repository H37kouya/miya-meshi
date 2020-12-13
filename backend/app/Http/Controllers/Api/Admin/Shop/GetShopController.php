<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Usecases\GetShopUsecase;
use Illuminate\Http\Request;

class GetShopController extends Controller
{
    private GetShopUsecase $_getShopUsecase;

    public function __construct(GetShopUsecase $getShopUsecase)
    {
        $this->_getShopUsecase = $getShopUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $shopId)
    {
        return [
            "data" => $this->_getShopUsecase->invoke($shopId, false)
        ];
    }
}
