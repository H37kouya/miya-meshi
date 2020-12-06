<?php

use App\Models\SelectionPost;
use Illuminate\Database\Seeder;
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
        DB::beginTransaction();

        try {
            factory(SelectionPost::class, 100)->create();

            DB::commit();
        } catch (Exception $e) {
            Log::debug($e);
            throw $e;
            DB::rollBack();
        }
    }
}
