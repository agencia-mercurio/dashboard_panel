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
        Schema::create('op_transmissions', function (Blueprint $table) {
            $table->id();
            $table->integer('external_id')->nullable();
            $table->integer('uuid')->nullable();
            $table->string('name');
            $table->string('funeral_place');
            $table->string('public');

            $table->string('login')->nullable();
            $table->string('password')->nullable();
            $table->string('room_password')->nullable();
            
            $table->integer('country_id');
            $table->string('country');
            $table->integer('state_id');
            $table->string('state');
            $table->string('city');
            $table->string('event');
            $table->date('birth_date')->nullable();
            $table->date('death_date')->nullable();
            $table->timestamp('start_transmission')->nullable();
            $table->timestamp('end_transmission')->nullable();
            $table->string('event_place');
            $table->timestamp('start_event')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('op_transmissions');
    }
};


