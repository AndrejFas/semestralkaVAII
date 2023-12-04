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
        Schema::create('pouzivatelia', function (Blueprint $table) {
            
            $table->string('login',20)->unique();
            $table->timestamps();

            $table->string('meno',20);
            $table->string('priezvisko',20);
            $table->string('heslo',20);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pouzivatelia');
    }
};
