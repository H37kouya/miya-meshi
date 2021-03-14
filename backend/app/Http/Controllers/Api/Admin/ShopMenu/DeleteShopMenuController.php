<?php

namespace App\Http\Controllers\Api\Admin\ShopMenu;

use App\Http\Controllers\Controller;
use App\Usecases\DeleteShopMenuUsecase;
use Illuminate\Http\Request;

class DeleteShopMenuController extends Controller
{
    private DeleteShopMenuUsecase $_deleteShopMenuUsecase;

    public function __construct(DeleteShopMenuUsecase $deleteShopMenuUsecase)
    {
        $this->_deleteShopMenuUsecase = $deleteShopMenuUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $shopId, int $shopMenuId)
    {
        $this->_deleteShopMenuUsecase->invoke($shopMenuId);
    }
}
