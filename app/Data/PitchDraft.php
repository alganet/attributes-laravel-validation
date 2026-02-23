<?php

declare(strict_types=1);

namespace App\Data;

use Respect\Validation\Validators\ArrayType;
use Respect\Validation\Validators\AllOf;
use Respect\Validation\Validators\Between;
use Respect\Validation\Validators\Contains;
use Respect\Validation\Validators\Each;
use Respect\Validation\Validators\Email;
use Respect\Validation\Validators\In;
use Respect\Validation\Validators\IntVal;
use Respect\Validation\Validators\Length;
use Respect\Validation\Validators\Named;
use Respect\Validation\Validators\StringType;
use Respect\Validation\Validators\ShortCircuit;
use Respect\Validation\Validators\Templated;

final readonly class PitchDraft
{
    /**
     * @param  list<string>  $highlights
     */
    public function __construct(
        #[Named('Speaker Name', new AllOf(new StringType, new Length(new Between(4, 60))))]
        public string $speaker_name,
        
        #[Named('Speaker Email', new Email)]
        public string $speaker_email,
        
        #[Named('Talk Title', new ShortCircuit(new Length(new Between(12, 90)), new Contains('Laravel')))]
        public string $talk_title,
        
        #[Named('Talk Duration', new AllOf(new IntVal, new Between(20, 45)))]
        public int $talk_duration_minutes,
        
        #[Named('Skill Level', new Templated('Skill level must be either {{haystack|list:or}}.', new In(['intermediate', 'advanced'])))]
        public string $skill_level,
        
        #[Named('Highlights', new AllOf(
            new ArrayType,
            new Templated('Please add at least two highlights.', new Length(new Between(2, 4))),
            new Each(new Templated('Each highlight must be between 12 and 120 characters.', new Length(new Between(12, 120)))),
        ))]
        public array $highlights,
    ) {
    }

    /**
     * @return array{
     *     speaker_name: string,
     *     speaker_email: string,
     *     talk_title: string,
     *     talk_duration_minutes: int,
     *     skill_level: string,
     *     highlights: list<string>
     * }
     */
    public function toAttributes(): array
    {
        return [
            'speaker_name' => $this->speaker_name,
            'speaker_email' => $this->speaker_email,
            'talk_title' => $this->talk_title,
            'talk_duration_minutes' => $this->talk_duration_minutes,
            'skill_level' => $this->skill_level,
            'highlights' => $this->highlights,
        ];
    }
}
