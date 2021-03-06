<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    /**
     * @var \App\Models\Plan
     */
    private $planRepository;

    public function __construct(Plan $plan)
    {
        $this->planRepository = $plan;
    }
    public function index()
    {
        $plans = $this->planRepository
            ->latest()
            ->paginate();

        return view('admin.pages.plans.index', [
            'plans' => $plans,
        ]);
    }

    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(PlanRequest $request)
    {
        $this->planRepository->create($request->all());
        return redirect()->route('admin.plans.index');
    }

    public function show(int $id)
    {
        $plan = $this->planRepository->find($id);

        if(! $plan) {
            return redirect()->back();
        }

        return view('admin.pages.plans.show', [
            'plan' => $plan,
        ]);
    }

    public function destroy(int $id)
    {
        $plan = $this->planRepository->find($id);

        if(! $plan) {
            return redirect()->back();
        }

        $plan->delete();

        return redirect()->route('admin.plans.index');
    }

    public function search(PlanRequest $request)
    {
        $filters = $request->except('_token');
        $plans = $this->planRepository->search($request->input('filter'));

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters,
        ]);
    }

    public function edit(int $id)
    {
        $plan = $this->planRepository->find($id);

        if(! $plan) {
            return redirect()->back();
        }

        return view('admin.pages.plans.edit', [
            'plan' => $plan,
        ]);
    }

    public function update(int $id, Request $request)
    {
        $plan = $this->planRepository->find($id);

        if(! $plan) {
            return redirect()->back();
        }

        $plan->update($request->all());

        return redirect()->route('admin.plans.index');
    }
}
