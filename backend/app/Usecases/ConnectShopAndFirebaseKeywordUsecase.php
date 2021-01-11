<?php

namespace App\Usecases;

use App\Enum\Models\FirebaseKeywordModel;
use App\Models\Shop;
use Exception;
use Illuminate\Support\Facades\DB;

class ConnectShopAndFirebaseKeywordUsecase
{
    /**
     * invoke
     *
     * @return void
     */
    public function invoke(int $shopId, array $firebase_keyword_ids): void
    {
        DB::beginTransaction();

        try {
            /** @var Shop $shop */
            $shop = Shop::findOrFail($shopId);

            // 昔保存した値を削除
            $shop->firebaseKeyword()->delete();

            foreach ($firebase_keyword_ids as $firebase_keyword_id) {
                $shop->firebaseKeyword()->create([
                    FirebaseKeywordModel::firebase_keyword_id => $firebase_keyword_id,
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
