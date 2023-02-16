<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountType::create([
            'name' => 'General Account',
            'description' => 'Account for general purposes',
        ]);

        AccountType::create([
            'name' => 'Contributions Account',
            'description' => 'Account for contribution purposes',
        ]);

        AccountType::create([
            'name' => 'Savings Account',
            'description' => 'Account for savings purposes',
        ]);
    }
}
