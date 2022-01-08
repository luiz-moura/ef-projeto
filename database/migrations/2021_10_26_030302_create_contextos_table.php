<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContextosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contextos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')
                ->constrained('pessoas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('tipo');
            $table->string('vigencia')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contextos');
    }
}
