<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Notifications\TaskOverdueNotification;
use Carbon\Carbon;



class NotifyOverdueTasksController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/notify-overdue",
     *     summary="Send notifications for overdue tasks",
     *     tags={"Notifications"},
     *     @OA\Response(
     *         response=200,
     *         description="Notifications sent successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="Notificaciones enviadas"),
     *             @OA\Property(property="cantidad", type="integer", example=3)
     *         )
     *     ),
     *     @OA\Response(response=500, description="Server error")
     * )
     */

    public function __invoke(Request $request): JsonResponse
    {
        //

        $user = User::first();

        $overdueTasks = Task::where('completed', false)
            ->whereDate('due_date', '<', Carbon::today())
            ->get();

        foreach ($overdueTasks as $task) {
            $user->notify(new TaskOverdueNotification($task));
        }

        return response()->json([
            'status' => 'Notificaciones enviadas',
            'cantidad' => $overdueTasks->count()
        ]);

    }
}
