<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conduct extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
