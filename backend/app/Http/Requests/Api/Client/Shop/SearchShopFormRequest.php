<?php

namespace App\Http\Requests\Api\Client\Shop;

use App\Enum\PeriodOfTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchShopFormRequest extends FormRequest
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
            'limit'                  => 'integer|nullable',
            'firebase_keyword_ids'   => 'array|nullable',
            'firebase_keyword_ids.*' => 'string',
            'firebase_dish_ids'      => 'array|nullable',
            'firebase_dish_ids.*'    => 'string',
            'can_takeout'            => 'boolean|nullable',
            'can_gotoeat'            => 'boolean|nullable',
            'period_of_time'         => [
                'array',
                'nullable',
            ],
            'period_of_time.*'       => [
                'string',
                Rule::in(PeriodOfTime::getAll())
            ]
        ];
    }
}