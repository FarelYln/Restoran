<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
            $table->foreignId('meja_id')->constrained('mejas')->onDelete('cascade'); 
            $table->decimal('total', 10, 2); 
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid');
            $table->timestamps(); 
        });

        Schema::create('menu_pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_pesanan'); // Drop the pivot table first
        Schema::dropIfExists('pesanans'); // Then drop the 'pesanan' table
    }
}
