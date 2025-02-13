<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan');
            $table->decimal('gaji_pokok', 15, 2)->nullable()->default(0);
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('positions');
    }
};
