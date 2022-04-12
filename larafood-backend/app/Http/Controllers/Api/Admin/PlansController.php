<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function show(int $id)
    {
        $plan = $this->planRepository->find($id);

        abort_if(! $plan, Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);

        return response()->json($plan);
    }

    public function destroy(int $id)
    {
        $plan = $this->planRepository->find($id);

        abort_if(! $plan, Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);

        $plan->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
