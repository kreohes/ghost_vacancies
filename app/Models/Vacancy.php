<?php

namespace App\Models;

use Database\Factories\VacancyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    /** @use HasFactory<VacancyFactory> */
    use HasFactory;

    protected $fillable = ['title', 'url', 'posted_at', 'company_id'];

    protected function casts(): array
    {
        return [
            'posted_at' => 'date',
        ];
    }

    public static function validationRules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'company_id' => ['required', 'exists:companies,id'],
            'url' => ['nullable', 'url', 'max:255'],
            'posted_at' => ['nullable', 'date', 'before_or_equal:today'],
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function ghostRisk(): ?float
    {
        return Report::silenceShare($this->reports);
    }

    public function riskLabel(): string
    {
        $risk = $this->ghostRisk();

        if ($risk === null) {
            return 'not enough data';
        }

        if ($risk >= 0.6) {
            return 'high';
        }

        if ($risk >= 0.3) {
            return 'medium';
        }

        return 'low';
    }
}
