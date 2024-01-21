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

            $table->string('nazov',50);
            $table->string('veduci',30);
            $table->string('tutor',20)->nullable();
            $table->bigInteger('student')->nullable();
            $table->text('popis');
            $table->date('cas');
            $table->string('katedra',10);
            $table->string('odbor',10);
            $table->string('jazyk',2)->nullable();
            $table->string('stupen');
            $table->string('stav');
            

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
