<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Subject::create([
            'name' => 'Toán',
            'credits' => 3,
        ]);

        Subject::create([
            'name' => 'Văn',
            'credits' => 2,
        ]);

        Subject::create([
            'name' => 'Anh Văn',
            'credits' => 4,
        ]);
    }
}
