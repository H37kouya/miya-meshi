<?php

namespace App\Repositories;

use App\Models\SelectionPost;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateSelectionPostRepository
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
     * SelectionPostを追加する
     *
     * @param array $inputs
     * @return array
     * @throws Exception
     */
    public function invoke(
        array $inputs
    ): array {
        try {
            DB::beginTransaction();

            /** @var SelectionPost $selectionPost */
            $selectionPost = $this->_selectionPost->create([
                'title'       => $inputs['title'],
                'contents'    => Arr::get($inputs, 'contents', null),
                'description' => Arr::get($inputs, 'description', null),
                'release'     => Arr::get($inputs, 'release', false),
            ]);

            DB::commit();

            return $selectionPost->toArray();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
