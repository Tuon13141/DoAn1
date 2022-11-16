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
        Schema::create('host', function (Blueprint $table) {
            $table->id()->unique()->autoIncrement();
            $table->string('username', 20);
            $table->string('password', 255);
            $table->string('phone_number', 20);
            $table->string('email', 50);
            $table->string('name', 20);
            $table->string('hadAva', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
