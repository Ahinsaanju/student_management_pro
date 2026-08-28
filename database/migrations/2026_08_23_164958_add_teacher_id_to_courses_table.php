<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // Unsigned BigInteger එකක් විදියට teacher_id එකතු කිරීම (Foreign key check නැතුව)
            $table->unsignedBigInteger('teacher_id')->nullable()->after('semester');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('teacher_id');
        });
    }
};