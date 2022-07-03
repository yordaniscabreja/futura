<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Academy extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'plan_estudio',
        'recursos_academicos',
        'tecnologia',
        'tamano_grupos',
        'excelencia_profesores',
        'academic_program_id',
    ];

    protected $searchableFields = ['*'];

    public function academicProgram()
    {
        return $this->belongsTo(AcademicProgram::class);
    }
}
