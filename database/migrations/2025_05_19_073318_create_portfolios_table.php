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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Image::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('description');

            // Новые поля
            $table->string('client')->nullable();         // Клиент
            $table->date('completed_at')->nullable();     // Дата завершения
            $table->text('notes')->nullable();            // Дополнительные заметки


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
