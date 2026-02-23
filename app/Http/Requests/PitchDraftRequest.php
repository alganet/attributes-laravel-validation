<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\PitchDraft;
use Illuminate\Foundation\Http\FormRequest;

use function filter_var;
use function array_filter;
use function array_map;
use function array_values;
use function trim;

abstract class PitchDraftRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'speaker_name' => ['nullable', 'string'],
            'speaker_email' => ['nullable', 'string'],
            'talk_title' => ['nullable', 'string'],
            'talk_duration_minutes' => ['nullable', 'string'],
            'skill_level' => ['nullable', 'string'],
            'highlights' => ['nullable', 'array'],
            'highlights.*' => ['nullable', 'string'],
        ];
    }

    public function toPitchDraft(): PitchDraft
    {
        /** @var array<string, mixed> $sanitized */
        $sanitized = $this->validated();

        $highlights = array_values(array_filter(array_map('trim', $sanitized['highlights'] ?? [])));

        return new PitchDraft(
            speaker_name: trim((string) ($sanitized['speaker_name'] ?? '')),
            speaker_email: trim((string) ($sanitized['speaker_email'] ?? '')),
            talk_title: trim((string) ($sanitized['talk_title'] ?? '')),
            talk_duration_minutes: $this->normalizeDuration($sanitized['talk_duration_minutes'] ?? null),
            skill_level: trim((string) ($sanitized['skill_level'] ?? '')),
            highlights: $highlights,
        );
    }

    private function normalizeDuration(mixed $rawValue): int
    {
        if (is_int($rawValue)) {
            return $rawValue;
        }

        $normalized = filter_var(trim((string) $rawValue), FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);

        return $normalized ?? -1;
    }
}
