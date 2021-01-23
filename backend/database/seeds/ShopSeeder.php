<?php

use App\Models\Shop;
use App\Models\ShopInformation;
use App\Models\ShopMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 100;
        $now = Carbon::now();

        DB::beginTransaction();
        try {
            factory(Shop::class, $limit)
                ->create()
                ->each(function (Shop $shop) use ($now) {
                    $shop->shopInformation()->save(factory(ShopInformation::class)->make([
                        'id' => $shop->id
                    ]));

                    $shopMenus = factory(ShopMenu::class, 10)->make([
                        'shop_id' => $shop->id
                    ])->map(fn ($_shopMenu) => array_merge(
                        $_shopMenu->toArray(),
                        [
                            'created_at' => $now,
                            'updated_at' => $now
                        ]
                    ))->toArray();

                    $shop->shopMenus()->insert($shopMenus);
                });

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
