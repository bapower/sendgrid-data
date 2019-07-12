<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpamReportEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spam_report_event', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recipient_id');
            $table->foreign('recipient_id')->references('id')->on('recipient');
            $table->dateTime('event_date_time')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->text('useragent')->nullable();
            $table->text('sg_event_id')->nullable();
            $table->text('sg_message_id')->nullable();
            $table->boolean('tls')->nullable();
            $table->boolean('certificate_error')->nullable();
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
        Schema::dropIfExists('spam_report_event');
    }
}
