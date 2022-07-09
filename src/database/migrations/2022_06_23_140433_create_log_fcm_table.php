<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogFcmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_fcm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('receiver');
            $table->longText('message');
            $table->integer('_state')->default(0);
            $table->dateTime('schedule_time')->nullable();
            $table->integer('instant')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_fcm');
    }
}
