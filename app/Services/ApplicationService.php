<?php

namespace App\Services;

use App\Enums\ApplicationStatusEnum;
use App\Models\Application;
use App\Models\Department;
use App\Repository\Application\ApplicationRepository;
use Illuminate\Http\Request;

class ApplicationService
{
    public function __construct(
        private ApplicationRepository $applicationRepository
    ) {}

    public function getApplicationList(Request $request): array
    {
        $isUser = auth()->user()->isUser();
        return [
            'countApplications' => Application::Filters($request)
                ->when($isUser, function ($query) use ($isUser){
                    $query->where('user_id', auth()->id());
                })->count(),
            'countNew' => Application::Filters($request)
                ->when($isUser, function ($query) use ($isUser){
                    $query->where('user_id', auth()->id());
                })
                ->where('status', ApplicationStatusEnum::NEW->value)
                ->count(),
            'countInProgress' => Application::Filters($request)
                ->when($isUser, function ($query) use ($isUser){
                    $query->where('user_id', auth()->id());
                })
                ->whereIn('status', ApplicationStatusEnum::activeStatuses())
                ->count(),
            'countClosed' => Application::Filters($request)
                ->when($isUser, function ($query) use ($isUser){
                    $query->where('user_id', auth()->id());
                })
                ->whereIn('status', ApplicationStatusEnum::closedStatuses())
                ->count(),
            'applications' => $this->applicationRepository->getApplicationsPaginated($request),
            'departments' => Department::orderBy('title')->get(),
        ];
    }
}
