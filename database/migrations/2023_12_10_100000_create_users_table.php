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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->default('/pkg/fontawesome-6.5.1/svgs/solid/user.svg');
            $table->string('username', 20)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('permission', ['admin', 'creator', 'user'])->default('user');
            $table->enum('type', ['siswa', 'guru', 'pegawai'])->default('siswa');
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
