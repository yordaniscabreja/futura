<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Internalization extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'intercambios_movilidad',
        'facilidad_acceso',
        'relevancia_internacional',
        'convenios_internacionales',
        'segundo_idioma',
        'academic_program_id',
    ];

    protected $searchableFields = ['*'];

    public function academicProgram()
    {
        return $this->belongsTo(AcademicProgram::class);
    }
}
