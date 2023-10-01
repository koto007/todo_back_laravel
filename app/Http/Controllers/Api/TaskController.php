<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::select('tasks.*')
                // ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
                // ->orderBy('completed', 'ASC')
                ->orderBy('title')
                ->orderBy('created_at', 'DESC')
                ->get();
        return TaskResource::collection($tasks);
    }

    public function delete($id) {
        $task = Task::findOrFail($id);
        if ($id) $task->delete();
        else return response()->json(null);
        return response()->json(null);
    }

    public function updateLabel($id, Request $request) {
        $title = $request->request->get('key');
        $task = Task::findOrFail($id);
        if ($title) {
            $task->update([
                'title' => $title 
            ]);
        } else {
            return response('The task content cannot be empty.', 400);
        }
    }

    public function updateStatus($id, Request $request) {
        $task = Task::findOrFail($id);
        $task->update([
            'completed' => $request->request->get('key')
        ]);
    }

    public function register(Request $request) {
        $title = $request->request->get('label');
        if ($title) {
            $task = Task::create([
                'title' => $request->request->get('label'),
                'completed' => false,
                'created_at' => Date('Y-m-d H:i:s'),
                'updated_at' => Date('Y-m-d H:i:s')
            ]);
        } else {
            return response('The task content cannot be empty.', 400);
        }
    }
}
