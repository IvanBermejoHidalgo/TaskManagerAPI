<?php

namespace App\Http\Controllers;

use App\Services\ExternalApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GetPostsController extends Controller {

    public function __construct(private ExternalApiService $service) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(): JsonResponse
    {
        //
        try {
            return response()->json($this->service->getPosts());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error occurred.'], 500);
        }
    }
}
