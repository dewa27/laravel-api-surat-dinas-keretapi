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
            $table->string("nomor_surat");
            $table->string("yth");
            $table->string("dari");
            $table->string("hal");
            $table->string("tanggal");
            $table->string("nama_ttd");
            $table->string("nip_ttd");
            $table->text("isi");
            $table->text("tembusan");
            $table->string("filename");
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
