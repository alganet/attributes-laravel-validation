<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PitchDraftRequest;
use App\Http\Requests\StorePitchShowcaseApiRequest;
use App\Http\Requests\StorePitchShowcaseRequest;
use App\Models\Pitch;
use App\Support\RespectAttributeValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class PitchShowcaseController extends Controller
{
    public function show(): View
    {
        return view('pitch-showcase', [
            'appName' => config('app.name', 'Laravel'),
            'recentPitches' => Pitch::query()->recent()->limit(5)->get(),
            'advancedPitchCount' => Pitch::query()->advanced()->count(),
        ]);
    }

    public function store(
        StorePitchShowcaseRequest $request,
        RespectAttributeValidator $respectValidator,
    ): RedirectResponse {
        $pitch = $this->persist($request, $respectValidator);

        return to_route('pitch.showcase')->with('pitch_status', "Pitch #{$pitch->id} accepted.");
    }

    public function storeApi(
        StorePitchShowcaseApiRequest $request,
        RespectAttributeValidator $respectValidator,
    ): JsonResponse {
        $pitch = $this->persist($request, $respectValidator);
        $attributes = $pitch->toDraft()->toAttributes();

        return response()->json([
            'data' => [
                'id' => $pitch->id,
                ...$attributes,
                'submitted_at' => $pitch->created_at?->toIso8601String(),
            ],
            'status' => 'accepted',
            'message' => 'Pitch accepted.',
        ], 201);
    }

    private function persist(
        PitchDraftRequest $request,
        RespectAttributeValidator $respectValidator
    ): Pitch {
        $draft = $request->toPitchDraft();
        $respectValidator->validate($draft);

        return Pitch::query()->create($draft->toAttributes());
    }
}
