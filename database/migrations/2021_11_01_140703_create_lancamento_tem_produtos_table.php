<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLancamentoTemProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamento_tem_produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lancamento_id')
                ->constrained('lancamentos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('produto_id')
                ->constrained('produtos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('quantidade');
            $table->string('preco_unitario');
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
        Schema::dropIfExists('lancamento_tem_produtos');
    }
}
