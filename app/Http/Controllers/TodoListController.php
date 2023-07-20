<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Http\Resources\TodoListResource;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    function get()
    {
        return response()->json([
            'success' => true,
            'message' => 'Created',
            'data' => TodoListResource::collection(TodoList::query()
                ->get())
        ]);
    }

    function store(TodoListRequest $request)
    {
        $todoList = TodoList::query()
            ->create([
                'title' => $request->listTitle
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Created',
            'data' => $todoList
        ]);
    }
}
