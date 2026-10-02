<?php

namespace Database\Seeders;

use App\Models\ContactType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactTypeSeeder extends Seeder
{
    public function run(): void
    {
        $contactTypes = [
            'number',
            'telegram',
            'whatsapp',
            'instagram',
            'facebook',
            'twitter',
            'linkedin',
            'vk'
        ];

        foreach ($contactTypes as $contactType) {
            ContactType::query()->firstOrCreate(
                [
                    'type' => $contactType
                ],
                [
                    'type' => $contactType
                ]
            );
        }
    }
}
