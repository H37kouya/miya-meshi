<?php

namespace App\Repositories;

use App\Models\SelectionPost;
use App\Models\SelectionPostArea;
use App\Models\SelectionPostShop;
use Illuminate\Support\Arr;

class GetSelectionPostByFirebaseShopIdRepository
{
    private SelectionPost $_selectionPost;

    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct(SelectionPost $selectionPost)
    {
        $this->_selectionPost = $selectionPost;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(string $firebaseShopId)
    {
        /** @var SelectionPost[] $founds */
        $founds = $this->_selectionPost
            ->with(['selectionPostShops', 'selectionPostAreas'])
            ->whereRelease(true)
            ->whereHas('selectionPostShops', function ($query) use ($firebaseShopId) {
                /** @var \App\Models\SelectionPostShop $query */
                $query->whereFirebaseShopId($firebaseShopId);
            })->get([
                'id',
                'title',
                'description',
                'image',
                'release',
                'created_at',
                'updated_at'
            ]);


        foreach ($founds as $found) {
            $firebaseAreaIds = $found->selectionPostAreas->map(
                fn (SelectionPostArea $selectionPostArea) => $selectionPostArea->firebase_area_id
            );
            $firebaseShopIds = $found->selectionPostShops->map(
                fn (SelectionPostShop $selectionPostShop) => $selectionPostShop->firebase_shop_id
            );

            // いらないkeyの削除
            Arr::forget($found, 'selectionPostAreas');
            Arr::forget($found, 'selectionPostShops');
            Arr::set($found, 'firebase_area_ids', $firebaseAreaIds);
            Arr::set($found, 'firebase_shop_ids', $firebaseShopIds);
        }

        return $founds;
    }
}
