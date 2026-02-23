<?php

declare(strict_types=1);

namespace App\Models;

use App\Data\PitchDraft;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'speaker_name',
    'speaker_email',
    'talk_title',
    'talk_duration_minutes',
    'skill_level',
    'highlights',
])]
final class Pitch extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'talk_duration_minutes' => 'integer',
            'highlights' => 'array',
        ];
    }

    #[Scope]
    protected function recent(Builder $query): void
    {
        $query->latest();
    }

    #[Scope]
    protected function advanced(Builder $query): void
    {
        $query->where('skill_level', 'advanced');
    }

    public function toDraft(): PitchDraft
    {
        return new PitchDraft(
            speaker_name: (string) $this->speaker_name,
            speaker_email: (string) $this->speaker_email,
            talk_title: (string) $this->talk_title,
            talk_duration_minutes: (int) $this->talk_duration_minutes,
            skill_level: (string) $this->skill_level,
            highlights: $this->highlights,
        );
    }
}
