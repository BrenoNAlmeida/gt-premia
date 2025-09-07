<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PremioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $premios = [
            ['nome' => 'Garrafa Térmica', 'preco' => 100],
            ['nome' => 'Copo Térmico', 'preco' => 100],
            ['nome' => 'Livro - (Até R$50,00)', 'preco' => 100],
            ['nome' => 'Vale Mc Donalds (R$50,00)', 'preco' => 100],
            ['nome' => 'Vale Cinema - 02 Ingressos (Até R$50,00)', 'preco' => 100],
            ['nome' => 'Voucher Uber (R$50,00)', 'preco' => 100],
            ['nome' => '01 Mochila Le Novo Casual', 'preco' => 200],
            ['nome' => '01 Massagem Relaxante', 'preco' => 200],
            ['nome' => '01 Creatina', 'preco' => 200],
            ['nome' => '01 Whey', 'preco' => 250],
            ['nome' => '01 Kit Boticário', 'preco' => 300],
            ['nome' => 'Voucher Riachuelo (R$150,00)', 'preco' => 300],
            ['nome' => 'Voucher C&A (R$150,00)', 'preco' => 300],
            ['nome' => 'Voucher Camarões (R$150,00)', 'preco' => 400],
            ['nome' => 'Rodízio para Duas Pessoas Sal e Brasa (Sem Bebida)', 'preco' => 400],
            ['nome' => '01 Day Use (Aquaria)', 'preco' => 1000],
            ['nome' => 'Hotel em Pipa - 01 Diária', 'preco' => 1000],
            ['nome' => '01 Alexa', 'preco' => 1000],
            ['nome' => '01 Voucher Miranda Computação', 'preco' => 1000],
            ['nome' => 'Restaurante à Escolha', 'preco' => 1000],
        ];

        foreach ($premios as $premio) {
            DB::table('premios')->insert([
                'nome' => $premio['nome'],
                'descricao' => $premio['nome'], // Pode ser diferente se necessário
                'status' => 'disponivel',
                'imagem_path' => null,
                'imagem_nome' => null,
                'preco' => $premio['preco'],
                'quantidade' => 1,
                'retirado_por' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
