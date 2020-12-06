<?php

namespace App\Http\Requests\Api\Admin\SelectionPost;

use App\Enum\ContentMode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterSelectionPostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'               => 'required | string | max:100',
            'release'             => 'required | boolean',
            'content_mode'        => [
                'required',
                Rule::in([ContentMode::NORMAL, ContentMode::NO_CONTENT, ContentMode::ADVERTISING]),
            ],
            'description'         => 'string | nullable | max:100',
            'contents'            => 'string | nullable',
            'image'               => 'url | nullable | max:255',
            'link'                => 'url | nullable | max:255',
            'firebase_area_ids'   => 'array | nullable',
            'firebase_area_ids.*' => 'string',
            'firebase_shop_ids'   => 'array | nullable',
            'firebase_shop_ids.*' => 'string',
        ];
    }
}
