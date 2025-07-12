<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Http\JsonResponse;


class TaskController extends Controller {

    public function getTasks():array {
        return Task::select('id','title','description','completed','due_date')
            ->orderBy('id')
            ->get()->toArray();
    }

    public function getTaskById(int $idTask) {

        // try {

        //     $tasl = Task::find($idTask);

        // } catch (){
        //     return null;
        // }

        // return $tasl;

        $tasl = Task::find($idTask);
        return $tasl;
    }



    public function createTask(Request $request):JsonResponse {

        // Validate title
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',

        ]);

        // Create Task
        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'due_date' => $validated['due_date'] ?? null,
            'completed' => false,
        ]);

        return response()->json($task, 201);

    }

    public function taskCompleted(int $idTask):JsonResponse {

        // Find task
        $task = Task::find($idTask);

        // Update task
        $task->update([
            'completed' => true,
        ]);

        return response()->json($task, 200);

    }
}
