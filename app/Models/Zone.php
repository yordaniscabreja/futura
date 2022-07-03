<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zone extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'facilidad_transporte',
        'seguridad_zona',
        'opciones_parqueo',
        'opciones_vivir',
        'opciones_comer',
        'academic_program_id',
    ];

    protected $searchableFields = ['*'];

    public function academicProgram()
    {
        return $this->belongsTo(AcademicProgram::class);
    }
}
