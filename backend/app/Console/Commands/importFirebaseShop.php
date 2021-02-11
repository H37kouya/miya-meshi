<?php

namespace App\Console\Commands;

use App\Enum\importFirebasePeriodOfTime;
use App\Enum\Models\FirebaseShopModel;
use App\Enum\Models\ImageModel;
use App\Enum\Models\ShopInformationModel;
use App\Enum\Models\ShopModel;
use App\Enum\PriceRange;
use App\Models\FirebaseShop;
use App\Models\Image;
use App\Models\Shop;
use App\Models\ShopInformation;
use App\Models\ShopMenu;
use Arr;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class importFirebaseShop extends Command
{
    private $price_range;
    private $twitterLink;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generateImportFirebaseShop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import shop data from Firebase';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $json = Storage::get("1611386237135_shop_list.json");
        $json = mb_convert_encoding($json, "UTF-8");
        $arr = json_decode($json, true);
        foreach ($arr as $shopinfos) {
            unset($shopinfos["type"], $shopinfos["createdAt"], $shopinfos["updatedAt"]); // 無視すべき要素を落とす
            Arr::snake_keys($shopinfos); //キーをスネークケースにする
            $shop = Shop::create(array_merge([ShopModel::release => $shopinfos["public"]], $shopinfos));
            $shopid = $shop->id;
            FirebaseShop::create([FirebaseShopModel::shop_id => $shopid, FirebaseShopModel::firebase_shop_id => $shopinfos["id"]]); //犯人はこの行
            if (isset($shopinfos["price_range"])) { //このswitchブロックはcaseの表記に対応するjsonファイル中の値に表記ゆれを確認。要注意。
                switch ($shopinfos["price_range"]) {
                    case '~500円':
                        $this->price_range = PriceRange::UNDER_500;
                        break;
                    case '500円 ~ 1,000円' || '500円 ~ 1000円':
                        $this->price_range = PriceRange::BETWEEN_500_AND_1000;
                        break;
                    case '1,000円~2,000円':
                        $this->price_range = PriceRange::BETWEEN_1000_AND_2000;
                        break;
                    case '2000円~3000円':
                        $this->price_range = PriceRange::BETWEEN_2000_AND_3000;
                        break;
                    case '3000円~5000円':
                        $this->price_range = PriceRange::BETWEEN_3000_AND_5000;
                        break;
                    case '5000円~10000円':
                        $this->price_range = PriceRange::BETWEEN_5000_AND_10000;
                        break;
                    case '10000円~':
                        $this->price_range = PriceRange::OVER_10000;
                        break;
                    default:
                        throw new Exception("不正な価格帯名です");
                        break;
                }
            } else {
                $this->price_range = null;
            }
            ShopInformation::create(array_merge([
                ShopInformationModel::period_of_time => importFirebasePeriodOfTime::arr_to_string($shopinfos["time_zone"]),
                ShopInformationModel::price_range => $this->price_range,
            ], $shopinfos));
            ShopMenu::create(
                $shopinfos
            );
            foreach ($shopinfos["appearance_image_link"] as $link) {
                if ($link === "/no-image.png") {
                    continue;
                } else {
                    Image::create([
                        ImageModel::imageable_name => "appearance_image_link",
                        ImageModel::url => $link
                    ]);
                }
            }
            if ($shopinfos["image_link"] !== "/no-image.png") {
                Image::create([
                    ImageModel::imageable_name => "image_link",
                    ImageModel::url => $link
                ]);
            }
            foreach ($shopinfos["menu_image_link"] as $link) {
                if ($link === "/no-image.png") {
                    continue;
                } else {
                    Image::create([
                        ImageModel::imageable_name => "menu_image_link",
                        ImageModel::url => $link
                    ]);
                }
            }
        }
    }
}
