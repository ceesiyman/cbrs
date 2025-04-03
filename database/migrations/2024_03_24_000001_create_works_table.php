<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('constructor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('bid_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->text('description');
            $table->boolean('assigned')->default(false);
            $table->string('status')->default('pending');
            $table->date('start_date');
            $table->bigInteger('total_cost');
            $table->bigInteger('budget');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('works');
    }
}; 