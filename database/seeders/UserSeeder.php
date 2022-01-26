<?php

namespace Database\Seeders;

use App\Models\ApiToken;
use App\Models\Contact;
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
        $user = User::updateOrCreate(['email' => 'admin@gmail.com'],[
            'name' => 'admin',
            'last_name' => 'admin',
            'account_type' => 'seller',
            'password' => bcrypt('admin'),
        ]);
        Contact::updateOrCreate(['user_id' => $user->id],[
            'email' => $user->email,
            'email_confirmed' => true,
        ]);

        ApiToken::updateOrCreate(['user_id' => $user->id],[
            'api_token' => '99883a7127feaaf79a9a0c95b61f09fb',
            'api_token_expires' => '2022-11-10 12:51:26',
        ]);


        $user = User::updateOrCreate(['email' => 'admin2@gmail.com'],[
            'name' => 'admin2',
            'last_name' => 'admin2',
            'account_type' => 'seller',
            'password' => bcrypt('admin'),
        ]);
        Contact::updateOrCreate(['user_id' => $user->id],[
            'email' => $user->email,
            'email_confirmed' => true,
        ]);

        ApiToken::updateOrCreate(['user_id' => $user->id],[
            'api_token' => '99883a7127feaaf79a9a0c95b61f09fb',
            'api_token_expires' => '2022-11-10 12:51:26',
        ]);
    }
}
