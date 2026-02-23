# Laravel + Respect Attribute Validation Example

Minimal Laravel 13.x-dev project focused on one thing:

- Laravel handles transport and persistence concerns with PHP attributes
- Respect\Validation 3 handles domain validation through DTO attributes
- one `PitchDraft` DTO is reused by request mapping, validation, persistence, and API resource output

## Core Files

- `app/Http/Requests/StorePitchShowcaseRequest.php`
- `app/Http/Requests/StorePitchShowcaseApiRequest.php`
- `app/Http/Requests/PitchDraftRequest.php`
- `app/Data/PitchDraft.php`
- `app/Support/RespectAttributeValidator.php`
- `app/Http/Controllers/PitchShowcaseController.php`
- `app/Models/Pitch.php`
- `resources/views/pitch-showcase.blade.php`
- `routes/web.php`
- `routes/api.php`
- `tests/Feature/PitchShowcaseTest.php`

## Run

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Open `http://127.0.0.1:8000/showcase/pitch`

API endpoints:

- `POST /api/showcase/pitch`

## Test

```bash
php artisan test
```
