<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicProgram extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'snies_code',
        'acreditado',
        'credits',
        'numero_duracion',
        'periodo_duracion',
        'jornada',
        'precio',
        'university_id',
        'basic_core_id',
        'academic_level_id',
        'modality_id',
        'education_level_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'academic_programs';

    protected $casts = [
        'acreditado' => 'boolean',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function basicCore()
    {
        return $this->belongsTo(BasicCore::class);
    }

    public function academicLevel()
    {
        return $this->belongsTo(AcademicLevel::class);
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }
}
