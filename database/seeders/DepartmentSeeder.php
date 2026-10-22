<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Руководство',
            'Бухгалтерия',
            'Отдел кадров',
            'Отдел продаж',
            'Отдел маркетинга',
            'Отдел разработки',
            'Отдел поддержки',
            'Юридический отдел',
            'Логистика',
            'Служба безопасности',
        ];

        foreach ($titles as $title) {
            Department::query()->firstOrCreate(['title' => $title], ['title' => $title]);
        }
    }
}
