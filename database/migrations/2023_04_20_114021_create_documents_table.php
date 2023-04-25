<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string("nomor_surat")->nullable();
            $table->string("yth")->nullable();
            $table->string("dari")->nullable();
            $table->string("hal")->nullable();
            $table->string("tanggal")->nullable();
            $table->string("nama_ttd")->nullable();
            $table->string("nip_ttd")->nullable();
            $table->text("isi")->nullable();
            $table->text("tembusan")->nullable();
            $table->string("filename")->nullable();
            $table->tinyInteger("isFavorite")->default(0);
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
        Schema::dropIfExists('documents');
    }
}
