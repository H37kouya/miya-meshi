<?php

namespace App\Http\Controllers\Api\Admin\ShopMenu;

use App\Http\Controllers\Controller;
use App\Usecases\CreateShopMenuUsecase;
use Illuminate\Http\Request;

class RegisterShopMenuController extends Controller
{
    private CreateShopMenuUsecase $_createShopMenuUsecase;

    public function __construct(CreateShopMenuUsecase $createShopMenuUsecase)
    {
        $this->_createShopMenuUsecase = $createShopMenuUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $shopId)
    {
        return $this->_createShopMenuUsecase->invoke(
            $shopId,
            $request->all()
        );
    }
}
