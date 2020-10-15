<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->create([
            'name'           => 'tester1',
            'api_token'      => '1234567890aa',
            'remember_token' => $user->createRememberToken(),
            'active'         => true
        ]);

        $user->create([
            'name'           => 'tester2',
            'api_token'      => '1234567890bb',
            'remember_token' => $user->createRememberToken(),
            'active'         => false
        ]);
    }
}
