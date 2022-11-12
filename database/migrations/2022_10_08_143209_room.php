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
        Schema::create('room', function (Blueprint $table) {
            $table->id()->unique()->autoIncrement();
            $table->integer('number');
            $table->string('status', 20);
            $table->integer('price');
            $table->integer('motel_id');
            $table->string('host_username', 40);
            $table->integer('area');
            $table->string('qc', 20);
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
