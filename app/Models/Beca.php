<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beca extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'academic_program_id'];

    protected $searchableFields = ['*'];

    public function requeriments()
    {
        return $this->hasMany(Requeriment::class);
    }

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }

    public function academicProgram()
    {
        return $this->belongsTo(AcademicProgram::class);
    }
}
