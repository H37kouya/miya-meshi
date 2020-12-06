<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        $now = Carbon::now();

        try {
            User::insert(
                [
                    'name'           => 'tester1',
                    'api_token'      => '1234567890aa',
                    'remember_token' => 'remember1234567890aa',
                    'active'         => true,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ],
                [
                    'name'           => 'tester2',
                    'api_token'      => '1234567890bb',
                    'remember_token' => 'remember1234567890bb',
                    'active'         => false,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ]
            );

            factory(User::class, 3)->create();

            DB::commit();
        } catch (Exception $e) {
            Log::debug($e);
            throw $e;
            DB::rollBack();
        }
    }
}
