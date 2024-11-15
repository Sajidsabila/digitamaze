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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classroom_id');
            $table->string('nis')->unique();
            $table->string('photo');
            $table->string('name');
            $table->enum('gender', ['Laki - laki', 'Perempuan']);
            $table->string('phone');
            $table->timestamps();
            $table->foreign('classroom_id')->references('id')->on('kelas')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
