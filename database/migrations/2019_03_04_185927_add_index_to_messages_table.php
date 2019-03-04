<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->index(['message','user_id'], 'messages_message_user_id_idx');
            $table->index('message', 'messages_message_idx');
            $table->index('user_id', 'messages_user_id_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropIndex(['messages_message_user_id_idx', 'messages_message_idx', 'messages_user_id_idx']);
        });
    }
}
