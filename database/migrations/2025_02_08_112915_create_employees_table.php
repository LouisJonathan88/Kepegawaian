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
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->string('nip')->unique();
        $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
        $table->string('email')->unique();
        $table->decimal('gaji', 10, 2);
        $table->unsignedBigInteger('department_id');
        $table->unsignedBigInteger('position_id');
        $table->timestamps();

        $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('employees');
}
};
