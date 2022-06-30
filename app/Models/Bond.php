<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bond extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'agreement_id'];

    protected $searchableFields = ['*'];

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }
}
