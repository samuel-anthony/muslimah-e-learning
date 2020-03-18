<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertanyaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertanyaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ujian_id');
            $table->string('soal_ujian');
            $table->string('jawaban_a');
            $table->string('jawaban_b');
            $table->string('jawaban_c');
            $table->string('jawaban_d');
            $table->integer('jawaban_benar');//harusnya dalam 1-4, 1 mewakili a, 2 b, 3 c, 4 d
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
        Schema::dropIfExists('pertanyaans');
    }
}
