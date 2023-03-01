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
        Schema::create('user_evento', function (Blueprint $table) {
            $table->foreignId("evento_id")->constrained("eventos");
            $table->foreignId("user_id")->constrained("users");
            $table->integer('numEntradas');
            $table->enum("estado", ['RECIBIDA', 'CONFIRMADA','CANCELADA']);
            $table->primary(["user_id", "evento_id"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_evento');
    }
};
