<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'path',
        'url',
        'media_type_id',
        'university_id',
    ];

    protected $searchableFields = ['*'];

    public function mediaType()
    {
        return $this->belongsTo(MediaType::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
