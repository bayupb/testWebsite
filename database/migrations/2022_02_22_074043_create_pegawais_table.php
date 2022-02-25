<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('gambar_pegawai')->nullable();
            $table->string('nip_pegawai')->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->string('tempat_lahir_pegawai')->nullable();
            $table->string('alamat_pegawai')->nullable();
            $table->string('tanggal_lahir_pegawai')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('npwp')->nullable();

            $table->boolean('jenis_kelamin_pegawai')->default(0)->nullable();

            $table->unsignedBigInteger('id_golongan');
            $table->foreign('id_golongan')->references('id')->on('golongan')->onDelete('cascade')->onUpdate('cascade')->nullable();

            $table->unsignedBigInteger('id_penempatan');
            $table->foreign('id_penempatan')->references('id')->on('penempatan')->onDelete('cascade')->onUpdate('cascade')->nullable();

            $table->unsignedBigInteger('id_agama');
            $table->foreign('id_agama')->references('id')->on('agama')->onDelete('cascade')->onUpdate('cascade')->nullable();

            $table->unsignedBigInteger('jabatan_id');
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('cascade')->onUpdate('cascade')->nullable();
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
        Schema::dropIfExists('pegawais');
    }
}
