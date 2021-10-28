<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->nullable();
            $table->string('codigo_barras')->nullable()->unique();
            $table->string('nome');
            $table->string('marca')->nullable();
            $table->string('ultimo_valor_custo')->nullable();
            $table->string('valor_venda')->nullable();
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
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign('categoria_id');
        });

        Schema::dropIfExists('produtos');
    }
}
