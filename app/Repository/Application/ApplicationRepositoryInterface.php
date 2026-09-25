<?php

namespace App\Repository\Application;

use App\Http\Requests\Application\ApplicationStoreRequest;
use App\Http\Requests\Application\ApplicationUpdateRequest;
use App\Models\Application;
use Illuminate\Pagination\LengthAwarePaginator;

interface ApplicationRepositoryInterface
{
    public function getApplicationPaginated(): LengthAwarePaginator;
    public function store(ApplicationStoreRequest $applicationStoreRequest): ?Application;
    public function update(ApplicationUpdateRequest $applicationUpdateRequest, Application $application): ?Application;
    public function destroy(Application $application): ?bool;
}
