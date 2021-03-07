<?php

use App\Models\SelectionPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SelectionPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::beginTransaction();

        try {
            $factorySelectionPosts = factory(SelectionPost::class, 100)->make()
                ->map(fn ($_selectionPost) => array_merge(
                    $_selectionPost->toArray(),
                    [
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                ))->toArray();
            SelectionPost::insert($factorySelectionPosts);

            DB::commit();
        } catch (Exception $e) {
            Log::debug($e);
            throw $e;
            DB::rollBack();
        }
    }
}
