<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Usecases\PaginateShopUsecase;
use Illuminate\Http\Request;

class IndexShopController extends Controller
{
    private PaginateShopUsecase $_paginateShopUsecase;

    public function __construct(PaginateShopUsecase $paginateShopUsecase)
    {
        $this->_paginateShopUsecase = $paginateShopUsecase;
    }

    public function __invoke(Request $request)
    {
        return $this->_paginateShopUsecase->invoke();
    }
}
