<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            [
                'nome'          => 'Coca Cola',
                'valor_venda'   => '10',
            ],
            [
                'nome'          => 'Pepse',
                'valor_venda'   => '10',
            ],
            [
                'nome'          => 'Dydyo Cola',
                'valor_venda'   => '10',
            ],
            [
                'nome'          => "Lind'Água Cola",
                'valor_venda'   => '3',
            ],
        ]);
    }
}
