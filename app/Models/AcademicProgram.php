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

    public function economies()
    {
        return $this->hasMany(Economy::class);
    }

    public function lifeStyles()
    {
        return $this->hasMany(LifeStyle::class);
    }

    public function wellnesses()
    {
        return $this->hasMany(Wellness::class);
    }

    public function prestiges()
    {
        return $this->hasMany(Prestige::class);
    }

    public function internalizations()
    {
        return $this->hasMany(Internalization::class);
    }

    public function campuses()
    {
        return $this->hasMany(Campus::class);
    }

    public function academies()
    {
        return $this->hasMany(Academy::class);
    }

    public function zones()
    {
        return $this->hasMany(Zone::class);
    }

    public function becas()
    {
        return $this->hasMany(Beca::class);
    }

    public function bonds()
    {
        return $this->hasMany(Bond::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
