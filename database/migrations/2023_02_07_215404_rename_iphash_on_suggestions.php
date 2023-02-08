<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::table('suggestions', function(Blueprint $table) {
            $table->dropColumn('iphash');
            $table->string('fingerprint')->after('topic_id');
        });
    }

    public function down()
    {
        Schema::table('suggestions', function(Blueprint $table) {
            $table->dropColumn('fingerprint');
            $table->string('iphash')->after('topic_id');
        });
    }

};
