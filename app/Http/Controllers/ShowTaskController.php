<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class ShowTaskController extends Controller
{
    public function __construct(private TaskService $service) {}

    public function __invoke(): JsonResponse
    {
        try {
            return response()->json($this->service->getTasks());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error occurred.'], 500);
        }
        // return response()->json($this->service->getTasks());
    }
}