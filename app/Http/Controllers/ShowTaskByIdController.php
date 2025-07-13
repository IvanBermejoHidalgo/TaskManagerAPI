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
     * Handle the incoming request.
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
