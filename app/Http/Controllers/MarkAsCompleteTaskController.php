<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class MarkAsCompleteTaskController extends Controller {

    public function __construct(private TaskService $service) {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(int $id): JsonResponse
    {
        //
        try {
            return response()->json($this->service->taskCompleted($id));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error occurred.'], 500);
        }
    }
}
