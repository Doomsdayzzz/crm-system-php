<?php

namespace App\Http\Controllers;

use App\Http\Requests\Application\ApplicationStoreRequest;
use App\Http\Requests\Application\ApplicationUpdateRequest;
use App\Models\Application;
use App\Models\Department;
use App\Models\User;
use App\Repository\Application\ApplicationRepository;
use App\Services\ApplicationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function __construct(
        private ApplicationRepository $applicationRepository,
        private ApplicationService $applicationService
    ) {}

    public function index(Request $request): View
    {
        return view('applications.index', $this->applicationService->getApplicationList($request));
    }

    public function create(): View
    {
        return view('applications.create', [
            'departments' => Department::orderBy('title')->get(),
            'users' => User::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(ApplicationStoreRequest $applicationStoreRequest): RedirectResponse
    {
        return redirect()
            ->route('applications.show', $this->applicationRepository->store($applicationStoreRequest))
            ->with('success', 'Заявка успешно создана.');
    }

    public function show(Application $application): View
    {
        Gate::authorize('view', $application);
        return view('applications.show', [
            'application' => $application->load(['user', 'department']),
        ]);
    }

    public function edit(Application $application): View
    {
        Gate::authorize('view', $application);

        return view('applications.edit', [
            'application' => $application,
            'departments' => Department::orderBy('title')->get(),
            'users' => User::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(ApplicationUpdateRequest $applicationUpdateRequest, Application $application): RedirectResponse
    {
        Gate::authorize('update', $application);
        $this->applicationRepository->update($applicationUpdateRequest, $application);

        return redirect()
            ->back()
            ->with('success', 'Заявка успешно обновлена.');
    }

    public function destroy(Application $application): RedirectResponse
    {
        Gate::authorize('delete', $application);
        $this->applicationRepository->destroy($application);

        return redirect()
            ->route('applications.index')
            ->with('success', 'Заявка успешно удалена.');
    }
}
