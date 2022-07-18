<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaturansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_app')->nullable();
            $table->string('singkatan')->nullable();
            $table->string('keterangan_app')->nullable();
            $table->string('logo_app')->nullable();
            $table->string('biaya_presenter')->nullable();
            $table->string('biaya_participant')->nullable();
            $table->string('persentase_pajak')->nullable();
            $table->string('bank')->nullable();
            $table->string('norek')->nullable();
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
        Schema::dropIfExists('pengaturans');
    }
}
