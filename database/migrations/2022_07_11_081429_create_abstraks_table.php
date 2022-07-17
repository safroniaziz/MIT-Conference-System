<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbstraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abstraks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('judul');
            $table->text('abstrak');
            $table->string('file_abstrak');
            $table->enum('status',['pending','diteruskan','disetujui','ditolak']);
            $table->integer('tahun_usulan');
            $table->string('file_paper')->nullable();
            $table->string('file_presentasi')->nullable();
            $table->enum('status_file',['dikirim','disetujui','revisi'])->nullable();
            $table->text('komentar_revisi')->nullable();
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
        Schema::dropIfExists('abstraks');
    }
}
