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
        Schema::create('form', function (Blueprint $table) {
            $table->id();
            $table->string('kop_surat')->default('kop surat.png');
            $table->date('tanggal_surat')->default(now()->format('Y-m-d'));
            $table->string('hal');
            $table->string('no_surat');
            $table->string('lampiran');
            $table->string('tujuan');
            $table->string('alamat');
            $table->text('salam_pembuka')->default("<p><em>Assalamu&rsquo;alaikum Wr. Wb.</em></p>
            <p>Puji syukur kehadirat Allah SWT yang telah memberikan limpahan rahmat kepada kita semua. Shalawat beriring salam kita kirimkan kepada Nabi Muhammad SAW sebagai tauladan kita. Doa dan harapan kami semoga Saudara senantiasa berada dalam keadaan sehat wal&rsquo;afiat. Aamiin.</p>
            <p>&nbsp;</p>");
            $table->text('isi_surat')->nullable();
            $table->text('salam_penutup')->default("<p>Demikianlah surat ini kami sampaikan. Atas perhatiannya kami ucapkan terima kasih.<br>Wassalamu&rsquo;alaikum Wr. Wb.</p>");
            $table->string('ttd_direktur')->nullable();
            $table->string('ttd_sekretaris')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form');
    }
};
