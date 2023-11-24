<?php

namespace App\Http\Controllers;

use App\Models\TodoModel;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TodosController extends Controller
{
    public function getAll(): JsonResponse
    {
        $todos = TodoModel::all();
        if ($todos->count()) {
            return response()->json($todos);
        } else {
            return response()->json([]);
        }
    }

    public function addTodo(Request $request, Response $response): JsonResponse
    {
        try {

            $title = $request->input('title');
            $newTodo = TodoModel::create(['title' => $title]);
            return response()->json(['message' => 'Successfully added'], 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function removeTodo(Request $request, string $id): JsonResponse
    {
        $todoToDelete = TodoModel::query()->find(intval($id));
        $todoToDelete->delete();
        return response()->json(['message' => 'Success delete']);
    }

    public function updateTodo(Request $request, string $id): JsonResponse
    {
        try {
            $todoItem = TodoModel::query()->find(intval($id));
            $todoItem->isCompleted = !boolval($todoItem->isCompleted);
            $todoItem->save();
            return response()->json(['message' => 'Success update']);
        } catch (\Exception $exception) {
            return response(null, 500)->json(['message' => $exception->getMessage()]);
        }
    }
}
