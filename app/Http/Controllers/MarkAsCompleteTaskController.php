<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class MarkAsCompleteTaskController extends Controller {

    public function __construct(private TaskService $service) {}
    /**
     * @OA\Put(
     *     path="/api/tasks/complete/{id}",
     *     summary="Mark a task as complete",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the task to mark complete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task marked as complete",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="completed", type="boolean")
     *         )
     *     ),
     *     @OA\Response(response=500, description="Server error")
     * )
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
