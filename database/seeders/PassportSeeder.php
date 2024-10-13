<?php

namespace Database\Seeders;

use App\Models\Passport;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = Student::first();

        Passport::create([
            'student_id' => $student->id,
            'passport_number' => 'A12345678',
            'issued_date' => now()->subYears(5),
            'expiry_date' => now()->addYears(5),
        ]);
    }
}
