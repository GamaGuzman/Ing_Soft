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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('field');
            $table->string('speciality');
            $table->integer('age');
            $table->string('RFC');
            $table->boolean('is_active')->default(true);
            $table->string('office_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
