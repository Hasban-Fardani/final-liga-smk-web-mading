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
            $table->string('username', 25)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('type', ['siswa', 'guru', 'staff'])->default('siswa');
            
            $table->enum('permission', ['admin', 'creator', 'read & comment', 'read only'])->default('read & comment');
            
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            
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
