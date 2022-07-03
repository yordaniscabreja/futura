<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'semestre', 'academic_program_id'];

    protected $searchableFields = ['*'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function academicProgram()
    {
        return $this->belongsTo(AcademicProgram::class);
    }
}
