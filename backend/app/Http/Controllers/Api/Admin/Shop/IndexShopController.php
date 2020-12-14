<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Shop\IndexShopFormRequest;
use App\Usecases\PaginateShopUsecase;

class IndexShopController extends Controller
{
    private PaginateShopUsecase $_paginateShopUsecase;

    public function __construct(PaginateShopUsecase $paginateShopUsecase)
    {
        $this->_paginateShopUsecase = $paginateShopUsecase;
    }

    public function __invoke(IndexShopFormRequest $request)
    {
        $serach = [
            'only_release' => $request->query('only_release', false),
            'limit'        => $request->query('limit', 10),
            'id'           => $request->query('id', null),
            'created_at'   => $request->query('created_at', null),
            'updated_at'   => $request->query('updated_at', null)
        ];

        return $this->_paginateShopUsecase->invoke($serach);
    }
}
