<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LifeStyle extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'ambiente',
        'diversion_ocio',
        'descanso_relax',
        'cultura_ecologica',
        'servicio_estudiante',
        'academic_program_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'life_styles';

    public function academicProgram()
    {
        return $this->belongsTo(AcademicProgram::class);
    }
}
