<?php

namespace App\Repositories;

use App\Models\SelectionPostShop;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class CreateSelectionPostShopRepository
{
    /**
     * SelectionPostShopを追加
     *
     * @param integer $selectionPostId
     * @param string[] $firebaseShopIds
     * @return array
     * @throws Exception
     */
    public function invoke(
        int $selectionPostId,
        array $firebaseShopIds
    ): array {
        $now = Carbon::now();

        $data = (new Collection($firebaseShopIds))->map(fn(string $firebaseShopId) => [
            'selection_post_id' => $selectionPostId,
            'firebase_shop_id'  => $firebaseShopId,
            'created_at'        => $now,
            'updated_at'        => $now,
        ])->all();

        SelectionPostShop::insert($data);

        return $firebaseShopIds;
    }
}
