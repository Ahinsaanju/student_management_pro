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
    Schema::create('learning_materials', function (Blueprint $table) {
        $table->id();
        $table->foreignId('module_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->text('description')->nullable();
        $table->enum('type', ['file', 'link'])->default('file');
        $table->string('file_path')->nullable(); // PDF / Document path
        $table->text('external_url')->nullable(); // Drive / YouTube link
        $table->foreignId('uploaded_by')->nullable(); // User ID
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_materials');
    }
};
