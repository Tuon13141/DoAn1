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
        Schema::create('admin', function (Blueprint $table) {
            $table->id()->unique()->autoIncrement();
            $table->string('username', 10);
            $table->string('password', 255);
            $table->string('email', 50);
            $table->string('phone_number', 20);
            $table->string('name', 40);
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
