<?php

namespace App\Repository\Application;

use App\Http\Requests\Application\ApplicationStoreRequest;
use App\Http\Requests\Application\ApplicationUpdateRequest;
use App\Models\Application;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    private const int PER_PAGE = 20;

    private const string CACHE_TAG = 'applications';

    public function getApplicationPaginated(): LengthAwarePaginator
    {
        $page = request()->input('page', 1);

        return Cache::tags([self::CACHE_TAG])
            ->remember("applications:page:{$page}", 300, function () {
                return Application::query()->paginate(self::PER_PAGE);
            });
    }

    public function store(ApplicationStoreRequest $applicationStoreRequest): ?Application
    {
        return Application::query()->create($applicationStoreRequest->validated());
    }

    public function update(ApplicationUpdateRequest $applicationUpdateRequest, Application $application): ?Application
    {
        $application->title = $applicationUpdateRequest->title;
        $application->description = $applicationUpdateRequest->description;
        $application->save();

        return $application;
    }

    public function destroy(Application $application): ?bool
    {
        return $application->delete();
    }
}
