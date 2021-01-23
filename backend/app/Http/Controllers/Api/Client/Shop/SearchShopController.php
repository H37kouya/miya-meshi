<?php

namespace App\Http\Controllers\Api\Client\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Shop\SearchShopFormRequest;
use App\Support\Arr;
use App\Usecases\ArgObjects\SearchShopArgObjects;
use App\Usecases\Client\SearchShopsUsecase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function __invoke(SearchShopFormRequest $request)
    {
        $period_of_time = $request->getByCamelKey('period_of_time');
        $search = SearchShopArgObjects::of([
            'limit'                => $request->getByCamelKey('limit', 10),
            'firebase_keyword_ids' => $request->getByCamelKey('firebase_keyword_ids'),
            'firebase_dish_ids'    => $request->getByCamelKey('firebase_dish_ids'),
            'can_takeout'          => $request->getByCamelKey('can_takeout'),
            'can_gotoeat'          => $request->getByCamelKey('can_gotoeat'),
            'period_of_time'       => explode(",", $period_of_time) || null,
        ]);

        $shops = $this->searchShopsUsecase->invoke($search);

        return [
            'data' => Arr::camel_keys($shops),
        ];
    }
}
