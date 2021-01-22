<?php

namespace App\Http\Controllers\Api\Client\Shop;

use App\Http\Controllers\Controller;
use App\Support\Arr;
use App\Usecases\ArgObjects\SearchShopArgObjects;
use App\Usecases\Client\SearchShopsUsecase;
use Illuminate\Http\Request;

class SearchShopController extends Controller
{
    private SearchShopsUsecase $searchShopsUsecase;

    public function __construct(SearchShopsUsecase $searchShopsUsecase)
    {
        $this->searchShopsUsecase = $searchShopsUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array
    {
        $search = SearchShopArgObjects::of([
            'limit'                => $request->query('limit', 10),
            'firebase_keyword_ids' => $request->query('firebase_keyword_ids'),
            'firebase_dish_ids'    => $request->query('firebase_dish_ids'),
            'can_takeout'          => $request->query('can_takeout'),
            'can_gotoeat'          => $request->query('can_gotoeat'),
            'period_of_time'       => $request->query('period_of_time'),
        ]);

        $shops = $this->searchShopsUsecase->invoke($search);

        return Arr::camel_keys($shops);
    }
}
