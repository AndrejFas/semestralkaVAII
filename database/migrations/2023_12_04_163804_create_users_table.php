<?php

use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * 
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('user_type', ['admin', 'veduci', 'student'])->default('student');
            $table->timestamps();
        });

        // Hashovanie hesla pri vytvorení používateľa
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'username' => 'admin',
            'password' => bcrypt('admin_password'),
            'user_type' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};