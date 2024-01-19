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
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('form_id');
            $table->string('field_name')->nullable();
            $table->string('field_label')->nullable();
            $table->string('field_type')->nullable();
            $table->string('field_value')->nullable();
            $table->text('field_options')->nullable();
            $table->enum('status', ['0', '1'])->default("1");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
