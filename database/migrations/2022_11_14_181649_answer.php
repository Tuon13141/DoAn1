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
        Schema::create('answer', function (Blueprint $table) {
            $table->id()->unique()->autoIncrement();
            $table->string('username', 20);
            $table->text('question');
            $table->text('answer');
            $table->text('created_at');
            $table->text('updated_at');
            $table->text('day_ask');
            $table->string('hadSeen', 20);
            $table->string('type', 20);
            $table->string('role', 20);
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
