<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('domains', function (Blueprint $table) {

            $table->id();

            $table->string('nama_domain')->unique();
            $table->string('epp_code')->nullable();
            $table->boolean('epp_hidden')->default(false);
            $table->longText('keterangan_domain')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_expired');
            $table->string('hosting')->nullable();
            $table->date('tanggal_hosting')->nullable();
            $table->string('lokasi_hosting')->nullable();
            $table->integer('kapasitas_hosting')->nullable();
            $table->string('biaya_perpanjangan')->default(650000);
            $table->string('paket_website')->nullable();
            $table->integer('jumlah_email')->nullable();
            $table->string('slug');

            $table->string('login_url')->nullable();
            $table->string('login_username')->nullable();
            $table->string('login_password')->nullable();

            $table->boolean('only_hosting')->default(false);
            $table->boolean('external_domain')->default(false);
            $table->string('vendor')->nullable();
            $table->enum('status', ['isFollowUp', 'isPending'])->nullable();
            $table->boolean('allow_remind')->default(false);

            $table->unsignedBigInteger('nameserver_id');
            $table->foreign('nameserver_id')->references('id')->on('name_servers')->onUpdate('CASCADE')->onDelete('cascade');
            $table->unsignedBigInteger('pelanggan_id');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onUpdate('CASCADE')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
