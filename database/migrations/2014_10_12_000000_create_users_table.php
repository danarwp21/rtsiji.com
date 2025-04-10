<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('name'); 
            $table->string('nik', 16)->unique()->after('name');
            $table->string('username')->unique()->after('nik');
            // $table->string('email')->unique();
            $table->string('password');
            $table->boolean('has_voted')->default(false);
            $table->unsignedInteger('kandidat_id')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropColumn('nik');
        });
    }
}


