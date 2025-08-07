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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('phone_number')->default('N/A'); 
            $table->string('email')->nullable();
            $table->string('home_town');
            $table->string('place_of_stay');
            $table->boolean('parent_status')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_number')->nullable();
            $table->string('marriage_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_number')->nullable();
            $table->integer('number_of_children')->default(0);
            $table->string('position')->default('Member');
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
