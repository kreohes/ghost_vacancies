<?php

namespace App\Models;

use Database\Factories\ReportFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /** @use HasFactory<ReportFactory> */
    use HasFactory;

    public const STATUSES = ['silence', 'replied', 'interview'];

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
}
