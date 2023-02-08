<?php

namespace Database\Seeders;

use App\Models\MeetingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetingTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MeetingType::create([
            'name' => 'General Meeting',
            'description' => 'General Meetings Metting Type',
            'is_recurring' => true,
            'recurring_freq' => 'yearly',
        ]);

        MeetingType::create([
            'name' => 'Impromptuu Meeting',
            'description' => 'Impromptuu Meetings Metting Type',
            'is_recurring' => false,
        ]);
    }
}
