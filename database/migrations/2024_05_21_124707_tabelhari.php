<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class tabelhari extends Migration
{
    public function up()
    {
        Schema::create('hari', function (Blueprint $table) {
            $table->id('id_hari');
            $table->string('nama_hari');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hari');
    }
}

