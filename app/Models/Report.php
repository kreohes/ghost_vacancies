<?php

namespace App\Models;

use Database\Factories\ReportFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Report extends Model
{
    /** @use HasFactory<ReportFactory> */
    use HasFactory;

    public const STATUSES = ['silence', 'replied', 'interview'];

    public const SILENCE_AFTER_DAYS = 14;

    public const MIN_REPORTS_FOR_RISK = 3;

    protected $fillable = ['status', 'applied_at', 'comment', 'vacancy_id'];

    protected function casts(): array
    {
        return [
            'applied_at' => 'date',
        ];
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function countsForRisk(): bool
    {
        if ($this->status !== 'silence') {
            return true;
        }

        return $this->applied_at->lte(now()->subDays(self::SILENCE_AFTER_DAYS));
    }

    public static function silenceShare(Collection $reports): ?float
    {
        $countedReports = $reports->filter(fn (Report $report) => $report->countsForRisk());

        if ($countedReports->count() < self::MIN_REPORTS_FOR_RISK) {
            return null;
        }

        return $countedReports->where('status', 'silence')->count() / $countedReports->count();
    }
}
