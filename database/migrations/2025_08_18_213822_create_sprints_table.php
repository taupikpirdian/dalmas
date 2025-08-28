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
        Schema::create('sprints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nomor');
            $table->string('nrp');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('pangkat')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('satuan')->nullable();
            $table->text('pertimbangan');
            $table->text('dasar');
            $table->text('tugas');
            $table->text('tembusan');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sprints');
    }
};
