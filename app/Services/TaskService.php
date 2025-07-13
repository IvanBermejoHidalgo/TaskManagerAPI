<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RuntimeException;

class TaskService {

    public function getTasks():array {

        try {

            return Task::select('id','title','description','completed','due_date')
                ->orderBy('id')
                ->get()->toArray();

        } catch (\Exception $e){
            throw new RuntimeException("Failed to show task: " . $e->getMessage(), 500);
        }
        
    }

    public function getTaskById(int $idTask) {

        try {
            $tasl = Task::find($idTask);
            return $tasl;

        } catch (\Exception $e){
            throw new RuntimeException("Failed to show task: " . $e->getMessage(), 500);
        }

        // $tasl = Task::find($idTask);
        // return $tasl;
    }




    public function createTask(array $data) {
        
        try {
            return Task::create([
                'title' => $data['title'],
                'description' => $data['description'] ?? '',
                'due_date' => $data['due_date'] ?? null,
                'completed' => false,
                'user_id' => $data['user_id'],
            ]);

        } catch (\Exception $e) {
            throw new RuntimeException("Failed to create task: " . $e->getMessage(), 500);
        }
    }




    public function taskCompleted(int $id) {

        try {
            // Find task
            $task = Task::find($id);

            // Update task
            $task->update([
                'completed' => true,
            ]);

            return response()->json($task, 200);

        } catch (\Exception $e) {
            throw new RuntimeException("Failed to mark complete task: " . $e->getMessage(), 500);
        }

    }



}