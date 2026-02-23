<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\Attributes\RedirectToRoute;

#[RedirectToRoute('pitch.showcase')]
final class StorePitchShowcaseRequest extends PitchDraftRequest
{
    //
}
