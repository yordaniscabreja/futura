<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Benefit extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'beca_id'];

    protected $searchableFields = ['*'];

    public function beca()
    {
        return $this->belongsTo(Beca::class);
    }
}
