<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Models\Department;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('add-application-to-users')]
#[Description('Command description')]
class AddApplicationToUsers extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usersIds = User::query()->select('id')->get()->pluck('id')->toArray();
        for ($i = 0; $i < count($usersIds); $i++) {
            $departments = Department::query()->get();
            Application::factory()->create([
                'user_id' => $usersIds[$i],
                'department_id' => $departments->random()->id,
                'title' => 'Верификация данных Claude',
                'description' => 'Необходимо подтвердить ваши данные, подготовьте паспорт и свое фото с паспортом!',
            ]);
        }

        return Command::SUCCESS;
    }
}
