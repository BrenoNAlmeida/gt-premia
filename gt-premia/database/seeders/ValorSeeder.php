<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $valores = [
            ['nome' => 'COMPROMETIMENTO' , 'cotacao' => 100],
            ['nome' => 'EXCELÊNCIA' , 'cotacao' => 100],
            ['nome' => 'FOCO NOS RESULTADOS' , 'cotacao' => 100],
            ['nome' => 'INTEGRIDADE' , 'cotacao' => 100],
            ['nome' => 'VALORIZAÇÃO DE PESSOAS' , 'cotacao' => 100],
            ['nome' => 'GENTE DE ATITUDE' , 'cotacao' => 1000],
        ];

        foreach ($valores as $valor) {
            DB::table('valores')->insert([
                'nome' => $valor['nome'],
                'cotacao' => $valor['cotacao'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
