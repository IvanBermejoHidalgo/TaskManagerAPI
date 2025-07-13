<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class ShowTaskByIdController extends Controller
{

    public function __construct(private TaskService $service) {}
    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     summary="Get a task by its ID",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the task",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task details",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="completed", type="boolean"),
     *             @OA\Property(property="due_date", type="string", format="date"),
     *             @OA\Property(property="user_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=500, description="Server error")
     * )
     */

    public function __invoke(int $id) {
        //
        try {
            return response()->json($this->service->getTaskById($id));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error occurred.'], 500);
        }
    }
}
