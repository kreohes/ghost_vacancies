<?php

namespace App\Support;

class ScamModel
{
    public const LIKELY_SCAM_FROM = 0.5;

    public const SUSPICIOUS_FROM = 0.2;

    private static ?array $model = null;

    public static function label(float $probability): string
    {
        if ($probability >= self::LIKELY_SCAM_FROM) {
            return 'likely scam';
        }

        if ($probability >= self::SUSPICIOUS_FROM) {
            return 'suspicious';
        }

        return 'looks normal';
    }

    public static function probability(string $text): float
    {
        $score = self::model()['intercept'] + array_sum(self::knownWordWeights($text));

        return 1 / (1 + exp(-$score));
    }

    public static function topWords(string $text, int $limit = 3): array
    {
        $weights = array_filter(self::knownWordWeights($text), fn (float $weight) => $weight > 0);
        arsort($weights);

        return array_slice(array_keys($weights), 0, $limit);
    }

    private static function knownWordWeights(string $text): array
    {
        preg_match_all('/\b\w\w+\b/u', mb_strtolower($text), $matches);

        $weights = [];
        foreach (array_unique($matches[0]) as $word) {
            if (isset(self::model()['weights'][$word])) {
                $weights[$word] = self::model()['weights'][$word];
            }
        }

        return $weights;
    }

    private static function model(): array
    {
        if (self::$model === null) {
            self::$model = json_decode(file_get_contents(resource_path('ml/scam-model.json')), true);
        }

        return self::$model;
    }
}
