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
        Schema::create('motel', function (Blueprint $table) {
            $table->id()->unique()->autoIncrement();
            $table->string('host_username', 40);
            $table->string('district', 20);
            $table->text('address');
            $table->text('describe');
            $table->string('status', 20);
            $table->int('number_of_rumber');
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
