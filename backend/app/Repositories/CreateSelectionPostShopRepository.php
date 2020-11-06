<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();
            $now = Carbon::now();

            $data = (new Collection($firebaseShopIds))->map(fn(string $firebaseShopId) => [
                'selection_post_id' => $selectionPostId,
                'firebase_shop_id'  => $firebaseShopId,
                'created_at'        => $now,
                'updated_at'        => $now,
            ])->all();

            DB::table('selection_post_shops')->insert($data);

            DB::commit();

            return $firebaseShopIds;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
