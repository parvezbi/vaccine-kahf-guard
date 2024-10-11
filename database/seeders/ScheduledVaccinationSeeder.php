<?php

namespace Database\Seeders;

use App\Models\ScheduledVaccination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduledVaccinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScheduledVaccination::factory()->count(1)->create();
    }
}
