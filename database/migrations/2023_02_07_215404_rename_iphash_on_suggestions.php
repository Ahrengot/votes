<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::table('suggestions', function(Blueprint $table) {
            $table->renameColumn("`iphash`", "`fingerprint`");
        });
    }

    public function down()
    {
        Schema::table('suggestions', function(Blueprint $table) {
            $table->renameColumn("`fingerprint`", "`iphash`");
        });
    }

};
