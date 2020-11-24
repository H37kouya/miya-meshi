<?php

use App\Models\User;
use Illuminate\Database\Seeder;
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

        try {
            User::insert(
                [
                    'name'           => 'tester1',
                    'api_token'      => '1234567890aa',
                    'remember_token' => 'remember1234567890aa',
                    'active'         => true
                ],
                [
                    'name'           => 'tester2',
                    'api_token'      => '1234567890bb',
                    'remember_token' => 'remember1234567890bb',
                    'active'         => false
                ]
            );

            DB::commit();
        } catch (Exception $e) {
            Log::debug($e);
            throw $e;
            DB::rollBack();
        }
    }
}
