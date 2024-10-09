<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($projectId)
    {
        try {
            $data = Task::where('project_id', $projectId)->get();

            if (!empty($data)) {
                return response()->json([
                    'data' => $data
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Không tồn tại dự án']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,  $projectId)
    {
        $data = $request->validate([
            'task_name' => 'required|string|max:255|unique:tasks,task_name',
            'description' => 'nullable|string',
            'status' => 'required|in:Chưa bắt đầu,Đang triển khai,Hoàn thành',
        ]);

        try {

            $data['project_id'] = $projectId;

            $task = Task::query()->create($data);

            return response()->json([
                'message' => 'Nhiệm vụ được tạo thành công',
                'task' => $task
            ], 201);
        } catch (\Throwable $th) {
            return response()->json('Tạo nhiệm vụ fail:' . $th->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $projectId, string $taskID)
    {
        try {
            $project = Task::query()->where('project_id', $projectId)->find($taskID);

            return response()->json($project);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Không tồn tại dự án']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, $projectId, string $taskId)
    {
        $data = $request->validated();

        try {

            $task = Task::query()->where('project_id', $projectId)->find($taskId);

            $task->update($data);

            return response()->json([
                'message' => 'Nhiệm vụ đã được cập nhật',
                'task' => $task
            ]);
        } catch (\Throwable $th) {
            return response()->json('Update nhiệm vụ fail:' . $th->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $projectId, string $taskID)
    {
        try {
            $task = Task::query()->where('project_id', $projectId)->find($taskID);
            $task->delete();

            return response()->json(["message" => "Nhiệm vụ được xóa"]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Lỗi hệ thống']);
        }
    }
}
