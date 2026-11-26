<?php

namespace App\Models;

use App\Support\ScamModel;
use Database\Factories\VacancyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    /** @use HasFactory<VacancyFactory> */
    use HasFactory;

    protected $fillable = ['title', 'description', 'url', 'posted_at', 'company_id'];

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
            'description' => ['nullable', 'string', 'max:10000'],
            'company_id' => ['required', 'exists:companies,id'],
            'url' => ['nullable', 'url', 'max:255'],
            'posted_at' => ['nullable', 'date', 'before_or_equal:today'],
        ];
    }

    public static function findByUrl(string $url): ?Vacancy
    {
        $url = rtrim(trim($url), '/');

        return self::where('url', $url)->orWhere('url', $url.'/')->first();
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

    public function countedReports()
    {
        return $this->reports->filter(fn (Report $report) => $report->countsForRisk());
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

    public function scamText(): string
    {
        return $this->title.' '.$this->description;
    }

    public function scamProbability(): ?float
    {
        if (! $this->description) {
            return null;
        }

        return ScamModel::probability($this->scamText());
    }

    public function scamWords(): array
    {
        return ScamModel::topWords($this->scamText());
    }
}
