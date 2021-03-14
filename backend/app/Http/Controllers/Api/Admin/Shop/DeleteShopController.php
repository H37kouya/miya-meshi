<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Usecases\DeleteShopUsecase;
use Illuminate\Http\Request;

class DeleteShopController extends Controller
{
    private DeleteShopUsecase $_deleteShopUsecase;

    public function __construct(DeleteShopUsecase $deleteShopUsecase)
    {
        $this->_deleteShopUsecase = $deleteShopUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $shopId)
    {
        $this->_deleteShopUsecase->invoke($shopId);
    }
}
