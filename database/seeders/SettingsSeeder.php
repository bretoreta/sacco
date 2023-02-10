<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'data' => [
                'loans' => [
                    'loan_application_allowed' => false,
                    'loan_application_max_users' => 100,
                ],
                'members' => [
                    'member_application_allowed' => false,
                ],
                'accounts' => [
                    'account_opening_allowed' => false,
                ],
            ]
        ]);
    }
}
