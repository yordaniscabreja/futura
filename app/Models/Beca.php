<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beca extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'university_id'];

    protected $searchableFields = ['*'];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function requeriments()
    {
        return $this->hasMany(Requeriment::class);
    }

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }
}
