<?php

use App\Models\Topic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('suggestions', function(Blueprint $table) {
            $table->ulid('id')->primary();

            $table->foreignIdFor(Topic::class)->constrained()->cascadeOnDelete();
            $table->string('iphash');
            $table->string('name');
            $table->unsignedSmallInteger('votes')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suggestions');
    }

};
