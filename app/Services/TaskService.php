<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RuntimeException;

/**
 * Service responsible for managing tasks.
*/
class TaskService {


    /**
     * Retrieves all tasks with selected fields.
     *
     * @return array An array of tasks.
     * @throws \RuntimeException If an error occurs while fetching tasks.
    */

    public function getTasks():array {

        try {

            return Task::select('id','title','description','completed','due_date')
                ->orderBy('id')
                ->get()->toArray();

        } catch (\Exception $e){
            throw new RuntimeException("Failed to show task: " . $e->getMessage(), 500);
        }
        
    }

    /**
     * Retrieves a task by its ID.
     *
     * @param int $idTask The ID of the task.
     * @return Task|null The task if found, or null.
     * @throws \RuntimeException If an error occurs while retrieving the task.
    */

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


    /**
     * Creates a new task with the given data.
     *
     * @param array $data Task data including title, description, due_date, and user_id.
     * @return Task The created task.
     * @throws \RuntimeException If an error occurs while creating the task.
    */

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


    /**
     * Marks a task as completed.
     *
     * @param int $id The ID of the task to mark as complete.
     * @return \Illuminate\Http\JsonResponse JSON response containing the updated task.
     * @throws \RuntimeException If an error occurs while updating the task.
    */

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