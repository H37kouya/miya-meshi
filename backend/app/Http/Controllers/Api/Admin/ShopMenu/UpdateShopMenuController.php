<?php

namespace App\Http\Controllers\Api\Admin\ShopMenu;

use App\Enum\Models\ShopMenuModel;
use App\Http\Controllers\Controller;
use App\Support\Arr;
use App\Usecases\UpdateShopMenuUsecase;
use Illuminate\Http\Request;

class UpdateShopMenuController extends Controller
{
    private UpdateShopMenuUsecase $_updateShopMenuUsecase;

    public function __construct(UpdateShopMenuUsecase $updateShopMenuUsecase)
    {
        $this->_updateShopMenuUsecase = $updateShopMenuUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $shopId, int $shopMenuId)
    {
        return Arr::camel_keys([
            "data" => $this->_updateShopMenuUsecase->invoke(
                $shopMenuId,
                Arr::snake_keys($request->except(Arr::camel_keys([
                    ShopMenuModel::period_of_time,
                ])))
            )
        ]);
    }
}
