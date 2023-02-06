<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('topics', function(Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('name');

            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('topics');
    }

};
