<?php

use App\Models\Suggestion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('votes', function(Blueprint $table) {
            $table->ulid('id')->primary();

            $table->foreignIdFor(Suggestion::class)->constrained()->cascadeOnDelete();
            $table->string('fingerprint')->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('votes');
    }

};
