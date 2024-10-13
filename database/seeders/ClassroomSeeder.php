<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Classroom::create([
            'name' => 'Lớp 12A1',
            'teacher_name' => 'Nguyễn Văn A',
        ]);

        Classroom::create([
            'name' => 'Lớp 11B2',
            'teacher_name' => 'Trần Thị B',
        ]);
    }
}
