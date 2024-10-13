<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $student = Student::first();
        $subjects = Subject::all();

        // // Gán tất cả các môn học cho sinh viên

        $classrooms = Classroom::all();

        for ($i = 1; $i <= 30; $i++) {
            $classroom = $classrooms->random();

            $student = Student::create([
                'name' => fake()->name(),
                'email' => fake()->email(),
                'classroom_id' => $classroom->id,
            ]);
            $student->passport()->create([
                'passport_number' => 'A123123' . $i,  // Nối chuỗi 'A123123' với $i
                'issued_date' => now()->subYears(5),
                'expiry_date' => now()->addYears(5),
            ]);
            $student->subjects()->attach($subjects->pluck('id')->toArray());
        }

    


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
