<?php

namespace App\Usecases;

use App\Models\SelectionPost;
use Illuminate\Support\Arr;

class GetSelectionPostUsecase
{
    private SelectionPost $_selectionPost;

    public function __construct(SelectionPost $selectionPost)
    {
        $this->_selectionPost = $selectionPost;
    }

    /**
     * SelectionPostの取得
     *
     * @param integer $selectionPostId
     * @param boolean $onlyRelease 公開中のみを取得する
     * @return array
     */
    public function invoke(
        int $selectionPostId,
        bool $onlyRelease = true
    ): array {
        /** @var SelectionPost */
        $selectionPost = $this->_selectionPost
            ->with(['selectionPostAreas', 'selectionPostShops'])
            ->when($onlyRelease, function($query) {
                $query->whereRelease(true);
            })->findOrFail($selectionPostId);

        $firebaseAreaIds = $selectionPost->selectionPostAreas->map(
            fn ($selectionPostArea) => $selectionPostArea->firebase_area_id
        );
        $firebaseShopIds = $selectionPost->selectionPostShops->map(
            fn ($selectionPostShop) => $selectionPostShop->firebase_shop_id
        );
        // いらないkeyの削除
        Arr::forget($selectionPost, 'selectionPostAreas');
        Arr::forget($selectionPost, 'selectionPostShops');
        Arr::set($selectionPost, 'firebase_area_ids', $firebaseAreaIds);
        Arr::set($selectionPost, 'firebase_shop_ids', $firebaseShopIds);

        return $selectionPost->toArray();
    }
}
