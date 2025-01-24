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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name');
            $table->string(column: 'title');
            $table->string(column: 'slug');
            $table->text(column: 'content')->nullable();
            $table->boolean(column: 'active')->default(true);
            $table->string(column: 'comments_enabled')->default(false);
            //$table->integer(column: 'user_id')->unsigned();
            //$table->foreign(columns: 'user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
