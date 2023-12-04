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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('nazov',20);
            $table->string('veduci',20);
            $table->string('tutor',20);
            $table->string('student',20)->nullable();
            $table->text('popis');
            $table->date('cas');
            $table->string('katedra',10);
            $table->string('odbor',10);
            $table->string('jazyk',2)->nullable();
            $table->integer('stupen');
            $table->integer('stav');
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
