<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateTaskRequest;
/**
 * @OA\Info(
 *     title="Task Manager API",
 *     version="1.0.0"
 * )
 */

class CreateTaskController extends Controller {

    public function __construct(private TaskService $service) {}
    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     summary="Create a new task",
     *     tags={"Tasks"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "user_id"},
     *             @OA\Property(property="title", type="string", example="Buy groceries"),
     *             @OA\Property(property="description", type="string", example="Milk, bread, cheese"),
     *             @OA\Property(property="due_date", type="string", format="date", example="2025-07-15"),
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Task created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="due_date", type="string", format="date"),
     *             @OA\Property(property="completed", type="boolean"),
     *             @OA\Property(property="user_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=500, description="Server error")
     * )
     */

    
    public function __invoke(CreateTaskRequest $request): JsonResponse {
        //
        $validated = $request->validated();
        try {

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
