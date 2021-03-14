<?php

namespace App\Repositories;

use App\Models\SelectionPost;
use App\Models\SelectionPostArea;
use App\Models\SelectionPostShop;
use App\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

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
     * @param string $firebaseShopId
     * @return array
     */
    public function invoke(string $firebaseShopId): array
    {
        /** @var SelectionPost[] $founds */
        $founds = $this->_selectionPost
            ->with(['selectionPostShops', 'selectionPostAreas'])
            ->nowPublicPosts(Carbon::now())
            ->whereHas('selectionPostShops', function ($query) use ($firebaseShopId) {
                /** @var \App\Models\SelectionPostShop $query */
                $query->whereFirebaseShopId($firebaseShopId);
            })->get([
                'id',
                'title',
                'description',
                'image',
                'contents',
                'content_mode',
                'link',
                'release',
                'publish_from',
                'publish_to',
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

        return (new Collection($founds))->all();
    }
}
