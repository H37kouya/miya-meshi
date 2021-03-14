<?php

namespace App\Repositories;

use App\Enum\ContentMode;
use App\Models\SelectionPost;
use App\Support\Arr;
use Illuminate\Support\Carbon;

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
        $publishFrom = Arr::get($inputs, 'publish_from', null) ? new Carbon($inputs['publish_from']) : null;
        $publishTo = Arr::get($inputs, 'publish_to', null) ? new Carbon($inputs['publish_to']) : null;

        /** @var SelectionPost $selectionPost */
        $selectionPost = $this->_selectionPost->create([
            'title'        => $inputs['title'],
            'contents'     => Arr::get($inputs, 'contents', null),
            'image'        => Arr::get($inputs, 'image', null),
            'description'  => Arr::get($inputs, 'description', null),
            'release'      => Arr::get($inputs, 'release', false),
            'content_mode' => Arr::get($inputs, 'content_mode', ContentMode::NORMAL),
            'link'         => Arr::get($inputs, 'link', null),
            'publish_from' => $publishFrom,
            'publish_to'   => $publishTo,
        ]);

        return $selectionPost->toArray();
    }
}
