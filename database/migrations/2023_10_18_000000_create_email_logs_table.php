<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->text('body')->nullable();
            $table->json('from')->nullable();
            $table->json('to')->nullable();
            $table->json('bbc')->nullable();
            $table->json('cc')->nullable();
            $table->json('reply_to')->nullable();
            $table->json('headers')->nullable();
            $table->json('attachments')->nullable();
            $table->boolean('is_html');
            $table->tinyInteger('priority', false, true);
            $table->nullableMorphs('authenticatable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_logs');
    }
};
