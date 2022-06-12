<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pistas', function (Blueprint $table) {
            $table->id();
            $table->boolean('09:00');
            $table->boolean('10:30');
            $table->boolean('12:00');
            $table->boolean('13:30');
            $table->boolean('15:00');
            $table->boolean('16:30');
            $table->boolean('18:00');
            $table->boolean('19:30');
            $table->boolean('21:00');
            $table->boolean('22:30');
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
        Schema::dropIfExists('pistas');
    }
}
