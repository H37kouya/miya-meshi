<?php

namespace App\Http\Controllers\Api\Admin\ShopMenu;

use App\Enum\Models\ShopMenuModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\ShopMenu\UpdateShopMenuFormRequest;
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
    public function __invoke(UpdateShopMenuFormRequest $request, int $shopId, int $shopMenuId)
    {
        return Arr::camel_keys([
            "data" => $this->_updateShopMenuUsecase->invoke(
                $shopMenuId,
                $request->exceptToSnakeKeysByCamelKeys([
                    ShopMenuModel::period_of_time,
                ])
            )
        ]);
    }
}
