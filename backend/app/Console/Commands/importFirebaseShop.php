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
use App\Support\Arr;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class importFirebaseShop extends Command
{
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
        $shouldInsertDataList = $this->getJsonData();
        DB::beginTransaction();

        try {
            foreach ($shouldInsertDataList as $shouldInsertData) {
                $this->doInsert($shouldInsertData);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function doInsert(array $shouldInsertData)
    {
        $originalShopInfo = $shouldInsertData;
        $originalShopInfo = Arr::snake_keys($originalShopInfo); //キーをスネークケースにする
        $originalShopInfo = Arr::except($originalShopInfo, ['type', 'created_at', 'updated_at']); // 無視すべき要素を落とす

        // Shopへの格納
        $shop = Shop::create([
            ShopModel::release      => Arr::get($originalShopInfo, "public"),
            ShopModel::publish_from => Arr::get($originalShopInfo, "publish_from"),
            ShopModel::publish_to   => Arr::get($originalShopInfo, "publish_to"),
            ShopModel::priority     => Arr::get($originalShopInfo, "priority"),
            ShopModel::display_mode => Arr::get($originalShopInfo, "display_mode"),
        ]);
        $shopId = $shop->id;

        // FirebaseShopへの格納
        FirebaseShop::create([
            FirebaseShopModel::shop_id          => $shopId,
            FirebaseShopModel::firebase_shop_id => $originalShopInfo["id"]
        ]); //犯人はこの行

        // priceRangeの取得
        $priceRange = $this->formatPriceRange(Arr::get($originalShopInfo, 'price_range'), $shopId);

        // ShopInformationへの格納
        // TODO period_of_timeのenum化
        ShopInformation::create(array_merge([
            'shop_id' => $shopId,
            ShopInformationModel::period_of_time => is_array(Arr::get($originalShopInfo, "time_zone")) ? importFirebasePeriodOfTime::arr_to_string(Arr::get($originalShopInfo, "time_zone")) : null,
            ShopInformationModel::price_range    => $priceRange,
        ], $originalShopInfo));

        foreach (Arr::get($originalShopInfo, "appearance_image_link", []) as $link) {
            if ($link === "/no-image.png") {
                continue;
            } else {
                Image::create([
                    ImageModel::imageable_name => "appearance_image_link",
                    ImageModel::url => $link
                ]);
            }
        }

        if (Arr::get($originalShopInfo, "image_link") !== "/no-image.png") {
            Image::create([
                ImageModel::imageable_name => "image_link",
                ImageModel::url => $link
            ]);
        }
        foreach (Arr::get($originalShopInfo, "menu_image_link") as $link) {
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

    /**
     * ファイルからjsonデータを取得する
     *
     * @return array
     */
    private function getJsonData(): array
    {
        $json = Storage::get("1611386237135_shop_list.json");
        $json = mb_convert_encoding($json, "UTF-8");
        $arr = json_decode($json, true);
        return $arr;
    }

    /**
     * PriceRangeのenum化
     *
     * @param string|null $price_range
     * @param integer $shopId
     * @return string|null
     */
    private function formatPriceRange(?string $price_range, int $shopId): ?string
    {
        if (!$price_range) {
            return null;
        }

        $newPriceRange = null; //このswitchブロックはcaseの表記に対応するjsonファイル中の値に表記ゆれを確認。要注意。
        switch ($price_range) {
            case '~500円':
                $newPriceRange = PriceRange::UNDER_500;
                break;
            case '500円 ~ 1,000円' || '500円 ~ 1000円':
                $newPriceRange = PriceRange::BETWEEN_500_AND_1000;
                break;
            case '1,000円~2,000円':
                $newPriceRange = PriceRange::BETWEEN_1000_AND_2000;
                break;
            case '2000円~3000円':
                $newPriceRange = PriceRange::BETWEEN_2000_AND_3000;
                break;
            case '3000円~5000円':
                $newPriceRange = PriceRange::BETWEEN_3000_AND_5000;
                break;
            case '5000円~10000円':
                $newPriceRange = PriceRange::BETWEEN_5000_AND_10000;
                break;
            case '10000円~':
                $newPriceRange = PriceRange::OVER_10000;
                break;
            default:
                // 不明な値はLogに書き込み、nullとして処理する
                Log::info("{$shopId}で不明なPriceRangeがありました。 {$price_range}");
                break;
        }

        return $newPriceRange;
    }
}
