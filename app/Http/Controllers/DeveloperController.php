<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeveloperResource;
use App\Services\Integration\IntegrationService;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(IntegrationService $integrationService)
    {
        return DeveloperResource::collection($integrationService->getPlans());
    }
}
