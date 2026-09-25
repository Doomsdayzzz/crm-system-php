<?php

namespace App\Repository\Application;

use App\Models\Application;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\Application\ApplicationStoreRequest;
use App\Http\Requests\Application\ApplicationUpdateRequest;

class ApplicationRepository implements ApplicationRepositoryInterface{

    private const int PER_PAGE = 20;
    public function getApplicationPaginated(): LengthAwarePaginator
    {
        return Application::query()
        ->paginate(self::PER_PAGE);
    }

    public function store(ApplicationStoreRequest $applicationStoreRequest): ?Application
    {
        return Application::query()->create($applicationStoreRequest->validated());
    }

    public function update(ApplicationUpdateRequest $applicationUpdateRequest, Application $application): ?Application
    {
        $application->title=$applicationUpdateRequest->title;
        $application->description=$applicationUpdateRequest->description;
        $application->save();
        return $application;
    }

    public function destroy(Application $application): ?bool
    {
        return $application->delete();
    }


}
