<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('body');
            $table->json('from');
            $table->json('to');
            $table->json('bbc');
            $table->json('cc');
            $table->json('reply_to');
            $table->json('headers');
            $table->json('attachments');
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
