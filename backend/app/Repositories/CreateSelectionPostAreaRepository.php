<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CreateSelectionPostAreaRepository
{
    /**
     * SelectionPostAreaを追加
     *
     * @param integer $selectionPostId
     * @param string[] $firebaseAreaIds
     * @return array
     * @throws Exception
     */
    public function invoke(
        int $selectionPostId,
        array $firebaseAreaIds
    ): array {
        try {
            DB::beginTransaction();
            $now = Carbon::now();

            $data = (new Collection($firebaseAreaIds))->map(fn(string $firebaseAreaId) => [
                'selection_post_id' => $selectionPostId,
                'firebase_area_id'  => $firebaseAreaId,
                'created_at'        => $now,
                'updated_at'        => $now,
            ])->all();

            DB::table('selection_post_areas')->insert($data);

            DB::commit();

            return $firebaseAreaIds;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
