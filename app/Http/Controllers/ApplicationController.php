<?php

namespace App\Http\Controllers;

use App\Http\Requests\Application\ApplicationStoreRequest;
use App\Http\Requests\Application\ApplicationUpdateRequest;
use App\Models\Application;
use App\Repository\Application\ApplicationRepository;
use App\Services\ApplicationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function __construct(private ApplicationService $appService, private ApplicationRepository $appRepository)
    {

    }

    public function index(): View
    {
        return view('applications.index', $this->appService->getApplicationList());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('applications.create', [
            'users' => \App\Models\User::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApplicationStoreRequest $request): RedirectResponse
    {
        return redirect()
            ->route('applications.edit', $this->appRepository->store($request))
            ->with('success', 'Application created successfully.');
    }

    /**
     * Display the specified resource.
     */
//    public function show(string $id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application): View
    {
        return view('applications.edit', [
            'application' => $application,
            'users' => \App\Models\User::query()->orderBy('name')->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApplicationUpdateRequest $request, Application $application): RedirectResponse
    {
        return redirect()
            ->route(
                'applications.edit',
                $this->appRepository->update($request, $application))
            ->with('success', 'Application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application): RedirectResponse
    {
        $this->appRepository->destroy($application);
        return redirect()
            ->route('applications.index')
            ->with('success', 'Application deleted successfully.');
    }
}
