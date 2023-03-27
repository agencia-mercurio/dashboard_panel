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
        Schema::create('dashboard_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('client_id');

            $table->string('context');
            $table->string('action')->comment('create, update, delete, login, logout, visualize, etc.');
            $table->string('description');
            $table->double('duration');
            $table->string('error')->comment('error message if any');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_logs');
    }
};
