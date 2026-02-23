<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PitchShowcaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_showcase_page_renders(): void
    {
        $response = $this->get(route('pitch.showcase'));

        $response
            ->assertOk()
            ->assertSee('Declarative Pitch Intake');
    }

    public function test_form_request_redirect_attribute_is_applied_when_respect_validation_fails(): void
    {
        $response = $this
            ->from(route('pitch.showcase'))
            ->post(route('pitch.showcase.store'), []);

        $response
            ->assertRedirect(route('pitch.showcase'))
            ->assertSessionHasErrors([
                'speaker_name',
                'speaker_email',
                'talk_title',
                'talk_duration_minutes',
                'skill_level',
                'highlights',
            ]);
    }

    public function test_respect_attributes_reject_domain_invalid_payload(): void
    {
        $payload = $this->validPayload();
        $payload['talk_title'] = 'Distributed systems field notes';
        $payload['talk_duration_minutes'] = '60';
        $payload['skill_level'] = 'beginner';
        $payload['highlights'] = ['Too short'];

        $response = $this
            ->from(route('pitch.showcase'))
            ->post(route('pitch.showcase.store'), $payload);

        $response
            ->assertRedirect(route('pitch.showcase'))
            ->assertSessionHasErrors([
                'talk_title',
                'talk_duration_minutes',
                'skill_level',
                'highlights',
            ]);

        $errors = session('errors')->getBag('default');

        $this->assertNotEmpty($errors->get('talk_title'));
        $this->assertNotEmpty($errors->get('talk_duration_minutes'));
        $this->assertNotEmpty($errors->get('skill_level'));
        $this->assertNotEmpty($errors->get('highlights'));
    }

    public function test_submission_succeeds_when_both_attribute_layers_pass(): void
    {
        $response = $this
            ->from(route('pitch.showcase'))
            ->post(route('pitch.showcase.store'), $this->validPayload());

        $response
            ->assertRedirect(route('pitch.showcase'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('pitch_status');

        $this->assertDatabaseHas('pitches', [
            'speaker_name' => 'Ada Lovelace',
            'speaker_email' => 'ada@example.test',
            'skill_level' => 'advanced',
        ]);
    }

    public function test_api_reuses_same_validation_flow_and_returns_422_errors(): void
    {
        $payload = $this->validPayload();
        $payload['talk_title'] = 'Distributed systems field notes';
        $payload['talk_duration_minutes'] = '60';
        $payload['skill_level'] = 'beginner';
        $payload['highlights'] = ['Too short'];

        $this->postJson('/api/showcase/pitch', $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'talk_title',
                'talk_duration_minutes',
                'skill_level',
                'highlights',
            ]);
    }

    public function test_api_accepts_valid_payload_and_returns_created_response(): void
    {
        $response = $this->postJson('/api/showcase/pitch', $this->validPayload())
            ->assertCreated()
            ->assertJsonPath('status', 'accepted')
            ->assertJsonPath('message', 'Pitch accepted.')
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'speaker_name',
                    'speaker_email',
                    'talk_title',
                    'talk_duration_minutes',
                    'skill_level',
                    'highlights',
                    'submitted_at',
                ],
                'status',
                'message',
            ]);

        $this->assertDatabaseHas('pitches', [
            'id' => $response->json('data.id'),
            'speaker_email' => 'ada@example.test',
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validPayload(): array
    {
        return [
            'speaker_name' => 'Ada Lovelace',
            'speaker_email' => 'ada@example.test',
            'talk_title' => 'Laravel event choreography for resilient teams',
            'talk_duration_minutes' => '35',
            'skill_level' => 'advanced',
            'highlights' => [
                'Maps failure boundaries using clear domain events.',
                'Demonstrates practical, test-first command handlers.',
                'Connects observability with real production feedback.',
            ],
        ];
    }
}
