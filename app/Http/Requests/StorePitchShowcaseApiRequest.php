<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\Attributes\StopOnFirstFailure;

#[StopOnFirstFailure]
final class StorePitchShowcaseApiRequest extends PitchDraftRequest
{
    //
}
