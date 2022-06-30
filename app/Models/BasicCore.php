<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BasicCore extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'knowledge_area_id'];

    protected $searchableFields = ['*'];

    protected $table = 'basic_cores';

    public function knowledgeArea()
    {
        return $this->belongsTo(KnowledgeArea::class);
    }

    public function academicPrograms()
    {
        return $this->hasMany(AcademicProgram::class);
    }
}
