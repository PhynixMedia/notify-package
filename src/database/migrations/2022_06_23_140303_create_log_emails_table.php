<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from')->index();
            $table->string('to')->index();
            $table->text('subject');
            $table->longText('message');
            $table->integer('_state')->default(0);
            $table->dateTime('schedule_time')->nullable();
            $table->integer('instant')->default(0);
            $table->integer('page_count')->default(1);
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
        Schema::dropIfExists('log_emails');
    }
}
