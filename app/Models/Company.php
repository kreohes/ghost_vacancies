<?php

namespace App\Models;

use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Company extends Model implements HasMedia
{
    /** @use HasFactory<CompanyFactory> */
    use HasFactory;

    use InteractsWithMedia;

    protected $fillable = ['name', 'website'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Crop, 160, 160)
            ->nonQueued();
    }

    public function logoUrl(): ?string
    {
        if (! $this->hasMedia('logo')) {
            return null;
        }

        return $this->getFirstMediaUrl('logo', 'thumb');
    }

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
