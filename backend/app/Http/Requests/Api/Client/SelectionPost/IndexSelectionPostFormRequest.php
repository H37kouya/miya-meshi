<?php

namespace App\Http\Requests\Api\Client\SelectionPost;

use Illuminate\Foundation\Http\FormRequest;

class IndexSelectionPostFormRequest extends FormRequest
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
            'limit'      => 'integer|nullable',
            'id'         => 'integer|nullable',
            'created_at' => 'string|nullable',
            'updated_at' => 'string|nullable',
        ];
    }
}
