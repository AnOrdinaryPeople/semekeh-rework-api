<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * type:
         * 1 = struktural
         *  1 = wakil (?)
         *  2 = kaprog
         *  3 = guru produktif
         * 2 = guru
         * 3 = karyawan
         */
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->tinyInteger('child_type')->default(0);
            $table->string('name');
            $table->string('title');
            $table->string('url')->default('user.webp');
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
        Schema::dropIfExists('employees');
    }
}
