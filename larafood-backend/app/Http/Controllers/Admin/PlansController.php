<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        $data = $request->all();
        $data['url'] = Str::kebab($request->name);
        $this->planRepository->create($data);

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

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $plans = $this->planRepository->search($request->input('filter'));

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters,
        ]);
    }
}
