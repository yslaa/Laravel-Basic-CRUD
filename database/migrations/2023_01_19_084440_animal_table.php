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

        Schema::create("animals", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "animal_name");
            $table->string(column: "animal_type");
            $table->integer(column: "age");
            $table->string(column: "gender");
            $table->string(column: "images")->default('example.jpg');
            $table->integer(column: "customer_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign("customer_id")
                ->references("id")
                ->on("customers")
                ->onUpdate("cascade")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("animals");
    }
};
