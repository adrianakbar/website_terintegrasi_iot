<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class tabellisttugas extends Migration
{
    public function up()
    {
        Schema::create('listtugas', function (Blueprint $table) {
            $table->id('id_tugas');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('id_hari');
            $table->foreign('id_hari')->references('id')->on('hari')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('listtugas');
    }
}

