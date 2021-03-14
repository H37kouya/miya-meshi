<?php

namespace App\Enum\Models;

class ShopModel
{
    public const id = 'id';
    public const release = 'release';
    public const publish_from = 'publish_from';
    public const publish_to = 'publish_to';
    public const priority = 'priority';
    public const display_mode = 'display_mode';
    public const deleted_at = 'deleted_at';
    public const created_at = 'created_at';
    public const updated_at = 'updated_at';
    public const shop_information = 'shop_information';
    public const images = 'images';

    public const image_link = 'image_link';
    public const sub_image_link = 'sub_image_link';
    public const menu_image_link = 'menu_image_link';
    public const appearance_image_link = 'appearance_image_link';

    public const withShopInformation = 'shopInformation';
    public const withImages = 'images';
}
