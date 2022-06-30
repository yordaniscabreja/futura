<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wellness extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'orientacion_psicologia',
        'actividades_deportivas',
        'actividades_culturales',
        'plan_covid19',
        'felicidad_entorno',
        'university_id',
    ];

    protected $searchableFields = ['*'];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
