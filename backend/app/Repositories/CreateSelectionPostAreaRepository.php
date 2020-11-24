<?php

namespace App\Repositories;

use App\Models\SelectionPostArea;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

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
        $now = Carbon::now();

        $data = (new Collection($firebaseAreaIds))->map(fn(string $firebaseAreaId) => [
            'selection_post_id' => $selectionPostId,
            'firebase_area_id'  => $firebaseAreaId,
            'created_at'        => $now,
            'updated_at'        => $now,
        ])->all();

        // バルクインサート
        SelectionPostArea::insert($data);

        return $firebaseAreaIds;
    }
}
