<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            createDefaultTableFields($table);

            // this can be later used for sorting rooms
            $table->integer('position')->unsigned()->nullable();
        });

        Schema::create('room_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'room');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('room_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'room');
        });
    }

    public function down()
    {
        Schema::dropIfExists('room_revisions');
        Schema::dropIfExists('room_translations');
        Schema::dropIfExists('rooms');
    }
};
