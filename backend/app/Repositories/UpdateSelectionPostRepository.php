<?php

namespace App\Repositories;

use App\Enum\ContentMode;
use App\Models\SelectionPost;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;

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
        $publishFrom = Arr::get($inputs, 'publish_from', null) ? new Carbon($inputs['publish_from']) : null;
        $publishTo = Arr::get($inputs, 'publish_to', null) ? new Carbon($inputs['publish_to']) : null;

        /** @var SelectionPost $selectionPost */
        $selectionPost = $this->_selectionPost->findOrFail($selectionPostId);
        $selectionPost->fill([
            'title'        => $inputs['title'],
            'contents'     => Arr::get($inputs, 'contents', null),
            'image'        => Arr::get($inputs, 'image', null),
            'description'  => Arr::get($inputs, 'description', null),
            'release'      => Arr::get($inputs, 'release', false),
            'content_mode' => Arr::get($inputs, 'content_mode', ContentMode::NORMAL),
            'link'         => Arr::get($inputs, 'link', null),
            'publish_from' => $publishFrom,
            'publish_to'   => $publishTo,
        ])->save();

        return $selectionPost->toArray();
    }
}
