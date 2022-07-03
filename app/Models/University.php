<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'oficial',
        'acreditada',
        'city_id',
        'principal',
        'url',
        'direccion',
        'fundada_at',
        'egresados',
        'general_description',
        'logo',
        'background_image',
        'about_video_url',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'oficial' => 'boolean',
        'acreditada' => 'boolean',
        'principal' => 'boolean',
        'fundada_at' => 'datetime',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function academicPrograms()
    {
        return $this->hasMany(AcademicProgram::class);
    }

    public function agreement()
    {
        return $this->hasOne(Agreement::class);
    }

    public function rectorias()
    {
        return $this->hasMany(Rectoria::class);
    }

    public function allMedia()
    {
        return $this->hasMany(Media::class);
    }

    public function convenios()
    {
        return $this->hasMany(Convenio::class);
    }
}
