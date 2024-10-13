<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'issued_date',
        'expiry_date',
        'passport_number',
    ];

    public function student()  {
        return $this->belongsTo(Student::class);
    }
}
