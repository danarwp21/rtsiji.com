<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFotoColumnOnCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('foto')->change();
        });
    }
    
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->integer('foto')->change(); // atau sesuai sebelumnya
        });
    }
    
}
