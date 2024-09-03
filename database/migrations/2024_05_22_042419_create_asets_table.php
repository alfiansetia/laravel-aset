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
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('name', 50);
            $table->integer('jumlah')->default(0);
            $table->integer('nilai')->default(0);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('jenis_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->enum('kondisi', ['baik', 'rusak'])->default('baik');
            $table->enum('status', ['terpakai', 'tidak terpakai'])->default('terpakai');
            $table->date('tgl_terima')->useCurrent();
            $table->integer('batas')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('jenis_id')->references('id')->on('jenis')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('location_id')->references('id')->on('locations')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
