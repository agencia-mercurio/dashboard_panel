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
        Schema::create('website_access_events', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('key')->comment('event key');
            $table->string('value')->comment('true/false or string description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_access_events');
    }
};
