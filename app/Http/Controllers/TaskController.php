<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Task;
use App\Validators\RequestValidator;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    const STATUS_ALL = 'all';
    const STATUS_COMPLETED = 'completed';
    const STATUS_PENDING = 'pending';

    public function findTasksByTeam(string $status = self::STATUS_ALL, int $id)
    {
        $query = Task::where(Task::TEAM_ID, $id);

        if ($status === self::STATUS_COMPLETED)
        {
            $query->where(Task::IS_COMPLETED, true);
        }
        else if ($status === self::STATUS_PENDING)
        {
            $query->where(Task::IS_COMPLETED, false);
        }

        $tasks = $query->orderBy(Task::CREATED_AT, 'desc')->get();
        return ApiResponse::success('Tareas encontradas correctamente', $tasks, null, 200);
    }

    public function findTasksByUserAndTeam(string $status = self::STATUS_ALL, int $teamId, int $userId)
    {
        $query = Task::where(Task::TEAM_ID, $teamId)
            ->where(Task::RESPONSIBLE_ID, $userId);

        if ($status === self::STATUS_COMPLETED)
        {
            $query->where(Task::IS_COMPLETED, true);
        }
        else if ($status === self::STATUS_PENDING)
        {
            $query->where(Task::IS_COMPLETED, false);
        }

        $tasks = $query->orderBy(Task::CREATED_AT, 'desc')->get();
        return ApiResponse::success('Tareas encontradas correctamente', $tasks, null, 200);
    }

    public function findOne(int $id)
    {
        $task = Task::find($id);

        if (!$task)
        {
            return ApiResponse::error('Tarea no encontrada', null, 404);
        }

        return ApiResponse::success('Tarea encontrada correctamente', $task, null, 200);
    }

    public function create(Request $request)
    {
        $validator = RequestValidator::validateTaskRequest($request);

        if (!$validator->isEmpty())
        {
            return ApiResponse::error('Errores de validación', $validator->messages(), 422);
        }

        $task = Task::create([
            Task::TITLE => $request->title,
            Task::BODY => $request->body,
            Task::RESPONSIBLE_ID => $request->responsible_id,
            Task::TEAM_ID => $request->team_id,
            Task::CREATED_BY => $request->user()->id
        ]);

        return ApiResponse::success('Tarea creada correctamente', $task, null, 201);
    }

    public function update(Request $request, int $id)
    {
        $validator = RequestValidator::validateTaskRequest($request);
        if (!$validator->isEmpty())
        {
            return ApiResponse::error('Errores de validación', $validator->messages(), 422);
        }

        $task = Task::find($id);
        if (!$task)
        {
            return ApiResponse::error('Tarea no encontrada', null, 404);
        }

        $task->title = $request->title;
        $task->body = $request->body;
        $task->responsible_id = $request->responsible_id;
        $task->team_id = $request->team_id;
        $task->save();

        return ApiResponse::success('Tarea actualizada correctamente', $task, null, 200);
    }

    public function addTaskToUser(Request $request, int $id)
    {
        $validator = RequestValidator::validateUserTaskRequest($request);
        if (!$validator->isEmpty())
        {
            return ApiResponse::error('Errores de validación', $validator->messages(), 422);
        }

        $task = Task::create([
            Task::TITLE => $request->title,
            Task::BODY => $request->body,
            Task::TEAM_ID => $request->team_id,
            Task::RESPONSIBLE_ID => $id,
            Task::CREATED_BY => $request->user()->id
        ]);

        return ApiResponse::success('Tarea creada correctamente', $task, null, 201);
    }


    public function markTaskAsCompleted(int $id)
    {
        $task = Task::find($id);
        if (!$task)
        {
            return ApiResponse::error('Tarea no encontrada', null, 404);
        }

        $task->is_completed = true;
        $task->completed_at = now();
        $task->save();

        return ApiResponse::success('Tarea marcada como completada', $task, null, 200);
    }

    public function unmarkTaskAsCompleted(int $id)
    {
        $task = Task::find($id);
        if (!$task)
        {
            return ApiResponse::error('Tarea no encontrada', null, 404);
        }

        $task->is_completed = false;
        $task->completed_at = null;
        $task->save();

        return ApiResponse::success('Tarea marcada como pendiente', $task, null, 200);
    }

    public function delete(int $id)
    {
        $task = Task::find($id);
        if (!$task)
        {
            return ApiResponse::error('Tarea no encontrada', null, 404);
        }

        $task->delete();
        return ApiResponse::success('Tarea eliminada correctamente', null, null, 200);
    }
}
