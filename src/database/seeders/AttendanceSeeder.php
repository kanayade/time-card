<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attendance::insert([
            [
                'user_id' => 1,
                'date' => '2026-07-01',
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'date' => '2026-07-02',
                'start_time' => '09:15:00',
                'end_time' => '18:15:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'date' => '2026-07-03',
                'start_time' => '08:45:00',
                'end_time' => '17:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
