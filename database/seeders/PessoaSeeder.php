<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pessoas')->insert([
            [
                'nome'      => 'Vale',
                'cpf_cnpj'  => '94609931000135'
            ],
            [
                'nome'      => 'Petrobras',
                'cpf_cnpj'  => '54003518000108'
            ],
            [
                'nome'      => 'Itaú Unibanco',
                'cpf_cnpj'  => '72115861000126'
            ],
            [
                'nome'      => 'Ambev',
                'cpf_cnpj'  => '67865613000162'
            ],
            [
                'nome'      => 'Bradesco',
                'cpf_cnpj'  => '87961368000102'
            ],
            [
                'nome'      => 'WEG',
                'cpf_cnpj'  => '47561381000141'
            ],
            [
                'nome'      => 'Santander Brasil',
                'cpf_cnpj'  => '88054255000188',
            ],
            [
                'nome'      => 'Magazine Luiza',
                'cpf_cnpj'  => '44202478000170'
            ],
            [
                'nome'      => "Rede D'Or",
                'cpf_cnpj'  => '73698703000109'
            ]
        ]);
    }
}
