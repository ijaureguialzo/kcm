<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            // Datos del RSS
            $table->text('title');
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->text('url')->nullable();
            $table->string('uid')->index();
            $table->dateTimeTz('published')->nullable();

            // Datos propios
            $table->boolean('read')->default(false);

            $table->foreignId('feed_id')->constrained()->onDelete('cascade');

            $table->unique(['feed_id', 'uid']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
