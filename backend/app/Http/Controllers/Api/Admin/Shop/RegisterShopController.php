<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Usecases\CreateShopUsecase;
use Illuminate\Http\Request;

class RegisterShopController extends Controller
{
    private CreateShopUsecase $_createShopUsecase;

    public function __construct(CreateShopUsecase $createShopUsecase)
    {
        $this->_createShopUsecase = $createShopUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $shop = $this->_createShopUsecase->invoke($request->all());

        return response()->json([
            'data' => $shop
        ]);
    }
}
