<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create(['label' => 'In Progress', 'code' => 'INPR']);
        Status::create(['label' => 'Completed', 'code' => 'COMP']);
    }
}
