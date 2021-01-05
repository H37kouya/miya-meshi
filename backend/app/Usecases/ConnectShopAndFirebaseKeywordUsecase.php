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
    public function invoke(int $shopId, array $firebase_keyword_ids): array
    {
        DB::beginTransaction();

        try {
            /** @var Shop $shop */
            $shop = Shop::findOrFail($shopId);

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
