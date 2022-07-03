<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestige extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'reputacion_institucional',
        'practicas_profesionales',
        'imagen_egresado',
        'asociaciones_externas',
        'bolsa_empleo',
        'academic_program_id',
    ];

    protected $searchableFields = ['*'];

    public function academicProgram()
    {
        return $this->belongsTo(AcademicProgram::class);
    }
}
