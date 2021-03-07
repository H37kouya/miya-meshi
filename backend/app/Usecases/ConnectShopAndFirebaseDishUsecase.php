<?php

namespace App\Usecases;

use App\Enum\Models\FirebaseKeywordModel;
use App\Enum\Models\FirebaseDishModel;
use App\Models\Shop;
use Exception;
use Illuminate\Support\Facades\DB;

class ConnectShopAndFirebaseDishUsecase
{
    /**
     * (mysql)shopテーブルのidとfirebase_dishテーブルのidを紐づける
     *dishは料理のジャンルを持つ。keywordはサブ検索機能のためのidを持つ。
     * @return void
     */
    public function invoke(int $shopId, array $firebase_dish_ids): void
    {
        DB::beginTransaction();

        try {
            /** @var Shop $shop */
            $shop = Shop::findOrFail($shopId);

            // 昔保存した値を削除。更新時のかぶり防止。
            $shop->firebaseDish()->delete();
            //firebasedishで当該テーブルに接続。createでDBに保存。
            foreach ($firebase_dish_ids as $firebase_dish_id) {
                $shop->firebaseDish()->create([
                    FirebaseDishModel::firebase_dish_id => $firebase_dish_id,
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e; //Laravelが例外インスタンスを拾ってくれる
        }
    }
}
