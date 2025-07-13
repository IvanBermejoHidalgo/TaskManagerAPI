<?php

namespace App\Http\Controllers;

use App\Services\ExternalApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GetPostsController extends Controller {

    public function __construct(private ExternalApiService $service) {}

    /**
     * @OA\Get(
     *     path="/api/external",
     *     summary="Get posts from external API",
     *     tags={"External"},
     *     @OA\Response(
     *         response=200,
     *         description="List of posts",
     *         @OA\JsonContent(type="array", @OA\Items(type="object"))
     *     ),
     *     @OA\Response(response=500, description="Server error")
     * )
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
