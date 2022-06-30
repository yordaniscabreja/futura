<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediaType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['type'];

    protected $searchableFields = ['*'];

    protected $table = 'media_types';

    public function multimedias()
    {
        return $this->hasMany(Media::class);
    }
}
