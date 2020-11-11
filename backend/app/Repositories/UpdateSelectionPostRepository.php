<?php

namespace App\Repositories;

use App\Models\SelectionPost;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateSelectionPostRepository
{
    /**
     * SelectionPost Model
     */
    private SelectionPost $_selectionPost;

    public function __construct(SelectionPost $selectionPost)
    {
        $this->_selectionPost = $selectionPost;
    }

    /**
     * SelectionPostを更新する
     *
     * @param integer $selectionPostId
     * @param array $inputs
     * @return array
     * @throws Exception
     */
    public function invoke(
        int $selectionPostId,
        array $inputs
    ): array {
        try {
            DB::beginTransaction();

            /** @var SelectionPost $selectionPost */
            $selectionPost = $this->_selectionPost->findOrFail($selectionPostId);
            $selectionPost->fill([
                'title'       => $inputs['title'],
                'contents'    => Arr::get($inputs, 'contents', null),
                'image'       => Arr::get($inputs, 'image', null),
                'description' => Arr::get($inputs, 'description', null),
                'release'     => Arr::get($inputs, 'release', false),
            ])->save();

            DB::commit();

            return $selectionPost->toArray();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
