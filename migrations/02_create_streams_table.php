<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

return new class extends Migration
{
    public function up()
    {
        Capsule::schema()->create('streams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('record_id')->unique();
            $table->bigInteger('views');
            $table->string('image_filename');
            $table->foreignId('user_id')->constrained();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('streams');
    }
};
