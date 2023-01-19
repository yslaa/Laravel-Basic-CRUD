<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("investors", function (Blueprint $table) {
            $table->increments("id");
            $table->string("first_name", 255);
            $table->string("last_name", 255);
            $table->string("phone_number", 255);
            $table->string("images", 255)->default('example.jpg');
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("investors");
    }
};
