<?php

namespace App\Http\Requests\Api\Admin\ShopMenu;

use App\Enum\Models\ShopMenuModel;
use App\Support\Arr;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\JsonRequest;

class RegisterShopMenuFormRequest extends FormRequest
{
    use JsonRequest;

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
        return Arr::camel_keys([
            ShopMenuModel::release             => 'required|boolean',
            ShopMenuModel::publish_from        => 'string|nullable',
            ShopMenuModel::publish_to          => 'string|nullable',
            ShopMenuModel::priority            => 'integer|nullable',
            ShopMenuModel::name                => 'required|string|max:255',
            ShopMenuModel::description         => 'string|max:255',
            ShopMenuModel::intro               => 'string|max:255',
            ShopMenuModel::price               => 'integer|min:0',
            ShopMenuModel::period_of_time      => 'array',
            ShopMenuModel::period_of_time.'.*' => 'string',
            ShopMenuModel::is_tax_included     => 'required|boolean',
            ShopMenuModel::can_takeout         => 'required|boolean',
            ShopMenuModel::image_link          => 'string|nullable',
        ]);
    }
}
