<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            // Add a column to track if this is a direct hire request
            $table->boolean('is_hire_request')->default(false);
            $table->enum('hire_status', ['pending', 'accepted', 'declined'])->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn(['is_hire_request', 'hire_status']);
        });
    }
};
