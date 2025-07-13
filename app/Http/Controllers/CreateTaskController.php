<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CreateTaskController extends Controller {

    public function __construct(private TaskService $service) {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse {
        //
        try {

            $validated = $request->validate([
                'title' => 'required|string',
                'description' => 'nullable|string',
                'due_date' => 'nullable|date',
            ]);

            $task = $this->service->createTask($validated);

            return response()->json($task, 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error occurred.',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }
}
