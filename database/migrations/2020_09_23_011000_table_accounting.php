<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableAccounting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('accounting', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_kategori');
            $table->integer('jumlah_sampah');
            $table->string('disetor');
            $table->dateTime('tanggal_sampah');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounting');
    }
}
