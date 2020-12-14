<?php

namespace App\Http\Requests\Api\Admin\ShopMenu;

use App\Enum\Models\ShopMenuModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterShopMenuFormRequest extends FormRequest
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
            ShopMenuModel::release         => 'required|boolean',
            ShopMenuModel::publish_from    => 'string|nullable',
            ShopMenuModel::publish_to      => 'string|nullable',
            ShopMenuModel::priority        => 'integer|nullable',
            ShopMenuModel::name            => 'requierd|string|max:255',
            ShopMenuModel::description     => 'required|string|max:255',
            ShopMenuModel::intro           => 'required|string|max:255',
            ShopMenuModel::price           => 'required|integer|min:0',
            ShopMenuModel::period_of_time  => 'required|string',
            ShopMenuModel::is_tax_included => 'required|boolean',
            ShopMenuModel::can_takeout     => 'required|boolean',
            ShopMenuModel::image_link      => 'string|nullable',
        ];
    }
}
