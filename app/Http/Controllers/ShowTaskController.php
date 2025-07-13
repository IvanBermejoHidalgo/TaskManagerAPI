<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class ShowTaskController extends Controller
{
    public function __construct(private TaskService $service) {}

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="Get all tasks",
     *     tags={"Tasks"},
     *     @OA\Response(
     *         response=200,
     *         description="List of tasks",
     *         @OA\JsonContent(type="array", @OA\Items(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="completed", type="boolean"),
     *             @OA\Property(property="due_date", type="string", format="date"),
     *             @OA\Property(property="user_id", type="integer")
     *         ))
     *     ),
     *     @OA\Response(response=500, description="Server error")
     * )
     */

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