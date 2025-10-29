<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('category'); // IHK, Kemiskinan, Pertanian, dll
            $table->string('file_path')->nullable();
            $table->json('data')->nullable(); // JSON storage untuk data
            $table->string('source')->default('BPS Bangkalan');
            $table->year('year')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('datasets');
    }
};
