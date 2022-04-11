<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    private $planRepository;

    public function __construct(Plan $plan)
    {
        $this->planRepository = $plan;
    }
    public function index()
    {
        $plans = $this->repository->all();

        return view('admin.pages.plans.index');
    }
}
