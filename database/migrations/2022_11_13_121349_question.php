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
            $table->string('username', 20);
            $table->string('email', 50);
            $table->string('phone_number', 20);
            $table->text('question');
            $table->string('type', 40);
            $table->text('created_at');
            $table->text('updated_at');
            $table->string('hadAnwser');
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
