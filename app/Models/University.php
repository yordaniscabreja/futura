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
        'description',
        'image',
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

    public function zones()
    {
        return $this->hasMany(Zone::class);
    }

    public function campuses()
    {
        return $this->hasMany(Campus::class);
    }

    public function academies()
    {
        return $this->hasMany(Academy::class);
    }

    public function prestiges()
    {
        return $this->hasMany(Prestige::class);
    }

    public function internalizations()
    {
        return $this->hasMany(Internalization::class);
    }

    public function economies()
    {
        return $this->hasMany(Economy::class);
    }

    public function lifeStyles()
    {
        return $this->hasMany(LifeStyle::class);
    }

    public function wellnesses()
    {
        return $this->hasMany(Wellness::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function rectorias()
    {
        return $this->hasMany(Rectoria::class);
    }

    public function becas()
    {
        return $this->hasMany(Beca::class);
    }

    public function allMedia()
    {
        return $this->hasMany(Media::class);
    }
}
