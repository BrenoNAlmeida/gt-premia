<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedbacks = [
            [
                'feedback' => 'Muito bom!',
                'user_id' => 1,
                'valor_recebido_id' => 1,
            ],
            [
                'feedback' => 'Excelente!',
                'user_id' => 1,
                'valor_recebido_id' => 2,
            ],
            [
                'feedback' => 'Ótimo!',
                'user_id' => 1,
                'valor_recebido_id' => 3,
            ],
        ];

        foreach ($feedbacks as $feedback) {
            \App\Models\Feedback::create($feedback);
        }
    }
}
