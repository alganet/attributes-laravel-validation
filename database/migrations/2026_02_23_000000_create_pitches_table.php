<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pitches', function (Blueprint $table): void {
            $table->id();
            $table->string('speaker_name', 60);
            $table->string('speaker_email', 120);
            $table->string('talk_title', 90);
            $table->unsignedSmallInteger('talk_duration_minutes');
            $table->string('skill_level', 20);
            $table->json('highlights');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pitches');
    }
};
