<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Economy extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'financiacion',
        'becas_auxilio',
        'costos_calidad',
        'costos_manutencion',
        'costos_parqueadero',
        'academic_program_id',
    ];

    protected $searchableFields = ['*'];

    public function academicProgram()
    {
        return $this->belongsTo(AcademicProgram::class);
    }
}
