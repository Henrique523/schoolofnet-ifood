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
}
