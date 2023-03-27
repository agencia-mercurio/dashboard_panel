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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('ewt')->comment('Edit website text');
            $table->integer('ewi')->comment('Edit website images');
            $table->integer('ews')->comment('Edit website sections');

            $table->integer('vwt')->comment('Visualize website text');
            $table->integer('vwi')->comment('Visualize website images');
            $table->integer('vws')->comment('Visualize website sections');
            
            $table->integer('vwm')->comment('Visualize website messages');

            $table->integer('reply_wm')->comment('Reply website messages');

            $table->integer('folders_scheme')->comment('Folder scheme');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
