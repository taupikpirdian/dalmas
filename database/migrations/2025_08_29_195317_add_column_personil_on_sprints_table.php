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
        Schema::table('sprints', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->text('pertimbangan')->nullable()->change();
            $table->text('dasar')->nullable()->change();
            $table->text('tugas')->nullable()->change();
            $table->text('tembusan')->nullable()->change();
            $table->string('nama')->nullable()->after('end_date');
            $table->string('jenis_tugas')->nullable()->after('tugas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
