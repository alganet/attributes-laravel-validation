<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Validation\ValidationException;
use Respect\Validation\Exceptions\ValidationException as RespectValidationException;
use Respect\Validation\ValidatorBuilder as v;

final class RespectAttributeValidator
{
    public function validate(object $dto): void
    {
        try {
            v::attributes()->assert($dto);
        } catch (RespectValidationException $exception) {
            $messages = $exception->getMessages();
            unset($messages['__root__']);
            throw ValidationException::withMessages(
                $messages
            );
        }
    }
}
