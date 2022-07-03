<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campus extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'conectividad',
        'salones',
        'laboratorios',
        'cafeterias_restaurantes',
        'espacios_comunes',
        'academic_program_id',
    ];

    protected $searchableFields = ['*'];

    public function academicProgram()
    {
        return $this->belongsTo(AcademicProgram::class);
    }
}
