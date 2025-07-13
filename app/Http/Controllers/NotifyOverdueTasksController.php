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
     * Handle the incoming request.
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
