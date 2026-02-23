<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $appName }} x Respect Attribute Showcase</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap');

        :root {
            --ink: #11213d;
            --paper: #f4efe3;
            --focus: #ff5a34;
            --surface: #fffdf7;
            --line: #d8cfbb;
            --mint: #79ddb8;
            --ocean: #1b5fd5;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Space Grotesk", "Trebuchet MS", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 8% 10%, rgba(121, 221, 184, 0.45), transparent 38%),
                radial-gradient(circle at 85% 82%, rgba(27, 95, 213, 0.33), transparent 44%),
                linear-gradient(150deg, #fdf6eb 0%, #e8f3ff 46%, #f7f4ec 100%);
            display: grid;
            place-items: center;
            padding: 28px 14px;
        }

        .card {
            width: min(930px, 100%);
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.92), var(--surface));
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(17, 33, 61, 0.17);
            overflow: hidden;
        }

        .masthead {
            padding: 34px 34px 22px;
            border-bottom: 1px solid var(--line);
            background: linear-gradient(110deg, rgba(121, 221, 184, 0.2), rgba(27, 95, 213, 0.1));
        }

        .badge {
            display: inline-block;
            font-family: "IBM Plex Mono", monospace;
            font-size: 12px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 5px 10px;
            border-radius: 999px;
            border: 1px solid rgba(17, 33, 61, 0.25);
            background: rgba(255, 255, 255, 0.75);
        }

        h1 {
            margin: 14px 0 8px;
            line-height: 1.12;
            font-size: clamp(1.65rem, 1.4rem + 1.1vw, 2.25rem);
        }

        .lede {
            margin: 0;
            max-width: 68ch;
            line-height: 1.45;
            font-size: 1.02rem;
        }

        .status {
            margin-top: 16px;
            background: rgba(121, 221, 184, 0.22);
            border: 1px solid rgba(25, 104, 76, 0.26);
            border-radius: 12px;
            padding: 12px 14px;
            font-weight: 600;
        }

        .errors {
            margin-top: 16px;
            background: rgba(255, 90, 52, 0.08);
            border: 1px solid rgba(255, 90, 52, 0.4);
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 0.96rem;
            line-height: 1.45;
        }

        .errors ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        form {
            padding: 24px 34px 34px;
            display: grid;
            gap: 18px;
        }

        .row {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .field {
            display: grid;
            gap: 7px;
        }

        label {
            font-weight: 600;
            font-size: 0.95rem;
        }

        input,
        select,
        textarea {
            width: 100%;
            border-radius: 10px;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.9);
            padding: 11px 12px;
            color: var(--ink);
            font: inherit;
        }

        textarea {
            min-height: 92px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid color-mix(in srgb, var(--focus) 35%, transparent);
            border-color: var(--focus);
        }

        .hint {
            margin: 2px 0 0;
            font-size: 0.84rem;
            font-family: "IBM Plex Mono", monospace;
            color: color-mix(in srgb, var(--ink) 70%, white 30%);
        }

        .field-error {
            margin: 0;
            color: #9a2200;
            font-size: 0.84rem;
            font-weight: 600;
        }

        .stack {
            display: grid;
            gap: 10px;
        }

        button {
            appearance: none;
            border: 0;
            border-radius: 999px;
            padding: 12px 20px;
            font-size: 0.98rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            color: #fff;
            width: fit-content;
            background: linear-gradient(90deg, #ff5a34, #f97316);
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(255, 90, 52, 0.28);
        }

        .recent {
            border-top: 1px solid var(--line);
            padding: 0 34px 30px;
        }

        .recent h2 {
            margin: 22px 0 8px;
            font-size: 1.12rem;
        }

        .recent-list {
            display: grid;
            gap: 12px;
        }

        .pitch {
            border: 1px solid var(--line);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.75);
            padding: 12px 14px;
        }

        .pitch h3 {
            margin: 0 0 6px;
            font-size: 1rem;
            line-height: 1.3;
        }

        .pitch p {
            margin: 0;
            font-size: 0.92rem;
        }

        @media (max-width: 800px) {
            .row {
                grid-template-columns: 1fr;
            }

            .masthead,
            form,
            .recent {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<main class="card">
    <section class="masthead">
        <span class="badge">Laravel 13 x Respect 3</span>
        <h1>{{ $appName }} Declarative Pitch Intake</h1>
        <p class="lede">
            Laravel FormRequest attributes handle request behavior, while Respect attributes live directly on a DTO
            for domain-grade validation. Submit a proposal that is truly Laravel-centered and conference-ready.
        </p>

        @if (session('pitch_status'))
            <p class="status">{{ session('pitch_status') }}</p>
        @endif

        @if ($errors->any())
            <div class="errors">
                Validation issues found:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </section>

    @php
        $highlights = array_pad(array_slice((array) old('highlights', []), 0, 4), 4, '');
    @endphp

    <form method="POST" action="{{ route('pitch.showcase.store') }}">
        @csrf

        <div class="row">
            <div class="field">
                <label for="speaker_name">Speaker Name</label>
                <input id="speaker_name" name="speaker_name" value="{{ old('speaker_name') }}" required>
                @error('speaker_name')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label for="speaker_email">Speaker Email</label>
                <input id="speaker_email" name="speaker_email" type="email" value="{{ old('speaker_email') }}" required>
                @error('speaker_email')<p class="field-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="field">
            <label for="talk_title">Talk Title</label>
            <input id="talk_title" name="talk_title" value="{{ old('talk_title') }}" required>
            <p class="hint">Respect rule requires this title to include the word "Laravel".</p>
            @error('talk_title')<p class="field-error">{{ $message }}</p>@enderror
        </div>

        <div class="row">
            <div class="field">
                <label for="talk_duration_minutes">Duration (minutes)</label>
                <input id="talk_duration_minutes" name="talk_duration_minutes" type="number" min="10" max="90" value="{{ old('talk_duration_minutes') }}" required>
                <p class="hint">Domain rule: 20-45 minutes only.</p>
                @error('talk_duration_minutes')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label for="skill_level">Skill Level</label>
                <select id="skill_level" name="skill_level" required>
                    <option value="">Choose one...</option>
                    @foreach (['beginner', 'intermediate', 'advanced'] as $level)
                        <option value="{{ $level }}" @selected(old('skill_level') === $level)>{{ ucfirst($level) }}</option>
                    @endforeach
                </select>
                <p class="hint">Respect allows intermediate or advanced only.</p>
                @error('skill_level')<p class="field-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="stack">
            <label>Three-Line Highlights (submit 2-4 entries)</label>
            @error('highlights')<p class="field-error">{{ $message }}</p>@enderror
            @error('highlights.*')<p class="field-error">{{ $message }}</p>@enderror
            @foreach ($highlights as $index => $highlight)
                <div class="field">
                    <textarea name="highlights[]">{{ $highlight }}</textarea>
                </div>
            @endforeach
        </div>

        <button type="submit">Submit Pitch</button>
    </form>

    <section class="recent">
        <h2>Recently accepted pitches</h2>
        <p class="hint">Advanced proposals in storage: {{ $advancedPitchCount }}</p>

        @if ($recentPitches->isEmpty())
            <p class="hint">No pitches accepted yet.</p>
        @else
            <div class="recent-list">
                @foreach ($recentPitches as $pitch)
                    <article class="pitch">
                        <h3>{{ $pitch->talk_title }}</h3>
                        <p>{{ $pitch->speaker_name }} · {{ $pitch->skill_level }} · {{ $pitch->talk_duration_minutes }} min</p>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
</main>
</body>
</html>
