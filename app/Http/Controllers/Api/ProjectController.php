<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Project::with('tasks')->get();

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'project_name'  => 'required|string|max:255|unique:projects,project_name',
            'description'   => 'required|string',
            'start_date'    => 'required|date|after_or_equal:today',
        ]);

        try {

            $project = Project::query()->create($data);

            return response()->json([
                'message' => 'Dự án được tạo thành công',
                'data' => $project
            ], 201);
        } catch (\Throwable $th) {
            return response()->json('Tạo dự án fail:' . $th->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $project = Project::query()->find($id);

            return response()->json($project);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Không tồn tại dự án']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id)
    {
        $data = $request->validated();

        $project = Project::find($id);

        try {

            $project->update($data);

            return response()->json([
                'message' => 'Dự án được cập nhật thành công',
                'data' => $project
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Lỗi hệ thống']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $project = Project::query()->find($id);

            $project->delete();

            return response()->json(["message" => "Dự án được xóa"]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Lỗi hệ thống']);
        }
    }
}
