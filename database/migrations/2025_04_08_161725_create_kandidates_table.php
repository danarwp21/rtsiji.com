<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKandidatesTable extends Migration
{
    public function up()
    {
        Schema::create('kandidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->text('visi');
            $table->text('misi');
            $table->string('foto');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kandidates');
    }
}
