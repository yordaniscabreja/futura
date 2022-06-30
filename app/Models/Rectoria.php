<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rectoria extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'position',
        'image',
        'university_id',
        'last_name',
    ];

    protected $searchableFields = ['*'];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
