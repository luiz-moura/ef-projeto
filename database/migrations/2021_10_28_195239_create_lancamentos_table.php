<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLancamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contexto_id')
                ->constrained('contextos')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->nullable();
            $table->foreignId('empresa_id')
                ->constrained('contextos')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->nullable();
            $table->timestamps();
            $table->string('operacao');
            $table->dateTime('data_operacao');
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
        Schema::table('lancamentos', function(Blueprint $table) {
            $table->dropForeign('contexto_id');
            $table->dropForeign('empresa_id');
        });

        Schema::dropIfExists('lancamentos');
    }
}
