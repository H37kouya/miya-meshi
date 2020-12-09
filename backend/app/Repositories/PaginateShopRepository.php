<?php

namespace App\Repositories;

use App\Models\Shop;
use Illuminate\Support\Carbon;

class PaginateShopRepository
{
    /**
     * invoke
     *
     * @return void
     */
    public function invoke(
        bool $onlyRelease = true,
        int $limit = 10
    ): array {
        $cursor = [];

        $shops = Shop::when($onlyRelease, function($query) {
                $query->nowPublicPosts(Carbon::now());
            })->select([
                'id',
                'release',
                'publish_from',
                'publish_to',
                'priority'
            ])
            ->lampager()
            ->forward()
            ->limit($limit)
            ->orderByDesc('priority')
            ->orderByDesc('updated_at') // ORDER BY `updated_at` DESC, `created_at` DESC, `id` DESC
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->seekable()
            ->paginate($cursor)
            ->toArray(JSON_PRETTY_PRINT);

        return $shops;
    }
}
