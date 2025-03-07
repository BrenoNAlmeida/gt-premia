<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use App\Models\User;
use App\Models\Carteira;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $filePath = storage_path('app/Colaboradores.csv'); // Certifique-se de que o arquivo está no storage/app
        
        if (!file_exists($filePath)) {
            $this->command->error("Arquivo CSV não encontrado: {$filePath}");
            return;
        }
        
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); // Define a primeira linha como cabeçalho
        
        foreach ($csv as $record) {
            $user = User::create([
                'name' => $record['NOME'],
                'email' => $record['EMAIL'],
                'cpf' => preg_replace('/\D/', '', $record['CPF']), // Remove caracteres não numéricos do CPF
                'password' => Hash::make(preg_replace('/\D/', '', $record['CPF'])),
            ]);

            Carteira::create([
                'user_id' => $user->id,
                'saldo' => 0,
                'saldo_retido' => 0,
            ]);
            if($user->name == "KLEBER FERREIRA DA SILVA" || $user->name == "BRENO NASCIMENTO DE ALMEIDA")
                $user->assignRole('admin');
            else
                $user->assignRole('colaborador');            
        }
    }
}
