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
        'university_id',
    ];

    protected $searchableFields = ['*'];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
