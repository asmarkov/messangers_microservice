<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created')->useCurrent();
            $table->timestamp('updated')->useCurrent();
            $table->bigInteger('message_id')->nullable();
            $table->timestamp('wakeup')->nullable();
            $table->integer('messenger');
            $table->text('message');
            $table->timestamp('send_time')->nullable();
            $table->integer('message_status')->default(0);
            $table->integer('try_count')->default(0);
            $table->integer('user_id');
            $table->integer('error_code')->nullable();
            $table->text('error_message')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
