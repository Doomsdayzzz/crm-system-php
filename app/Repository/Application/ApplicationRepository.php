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

    private const string CACHE_KEY = 'applications';

    private const string CACHE_VERSION_KEY = 'applications:version';

    private const int CACHE_TTL = 300;

    public function getApplicationsPaginated(): LengthAwarePaginator
    {
        $page = request()->input('page', 1);
        $version = Cache::get(self::CACHE_VERSION_KEY, 1);

        return Cache::remember(
            self::CACHE_KEY.":v{$version}:page:{$page}",
            self::CACHE_TTL,
            function () {
                return Application::query()->paginate(self::PER_PAGE);
            }
        );
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
