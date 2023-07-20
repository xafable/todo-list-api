<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function get($listId): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => TaskResource::collection(Task::query()
                ->where('list_id', '=', $listId)
                ->orderByDesc('created_at')
                ->paginate(10))
        ]);
    }

    function update($id, TaskRequest $request): \Illuminate\Http\JsonResponse
    {
        Task::query()
            ->find($id)
            ->update([
                'title' => $request->taskTitle,
                'description' => $request->taskDescription,
                'status' => $request->taskStatus,
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Updated',
            'data' => new TaskResource(Task::query()
                ->find($id))
        ]);
    }

    function store(TaskRequest $request): \Illuminate\Http\JsonResponse
    {

        $task = Task::query()
            ->create([
                'title' => $request->taskTitle,
                'description' => $request->taskDescription,
                'status' => $request->taskStatus,
                'list_id' => $request->listId,
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Created',
            'data' => $task
        ]);
    }

    function destroy($id): \Illuminate\Http\JsonResponse
    {
        Task::query()
            ->find($id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted',
            'data' => ''
        ]);
    }
}
