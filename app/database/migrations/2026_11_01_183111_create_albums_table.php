<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
{
    Schema::create('albums', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('artist');
        $table->string('label');
        $table->text('full_description')->nullable();
        $table->date('release_date')->nullable();
        $table->string('cover_image')->nullable();
        $table->text('tracks')->nullable();
        $table->timestamps();
        $table->softDeletes();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
