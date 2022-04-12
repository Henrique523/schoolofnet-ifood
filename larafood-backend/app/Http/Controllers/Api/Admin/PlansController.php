<?php

namespace App\Http\Controllers\Api\Admin;

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

    public function store (Request $request)
    {
        $data = $request->all();
        $data['url'] = Str::kebab($request->name);
        $newPlan = $this->planRepository->create($data);

        return response()->json($newPlan);
    }
}
