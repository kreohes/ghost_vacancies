<?php

namespace App\Models;

use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<CompanyFactory> */
    use HasFactory;

    protected $fillable = ['name', 'website'];

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    public function reports()
    {
        return $this->hasManyThrough(Report::class, Vacancy::class);
    }

    public function noAnswerRate(): ?float
    {
        return Report::silenceShare($this->reports);
    }
}
