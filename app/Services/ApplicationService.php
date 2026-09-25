<?php

namespace App\Services;

use App\Repository\Application\ApplicationRepository;

class ApplicationService{
    public function __construct(private ApplicationRepository $appRepository)
    {

    }

    public function getApplicationList(): array
    {
        return [
            'applications' => $this->appRepository->getApplicationPaginated()
        ];
    }
}
