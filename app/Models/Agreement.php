<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agreement extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'duracion',
        'representante',
        'university_id',
        'tasa_interes',
        'tasa_descuento',
    ];

    protected $searchableFields = ['*'];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
