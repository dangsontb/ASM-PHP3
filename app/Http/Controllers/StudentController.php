<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data = Student::with('passport', 'classroom', 'subjects')
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('classroom', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })->latest('id')
            ->paginate(8);
// dd($data);
            return  view('students.index', compact('data', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $classrooms = Classroom::pluck('name', 'id');
        $subjects = Subject::select('id', 'name', 'credits')->get();

        return view('students.create', compact('classrooms', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();

            $student = Student::query()->create($data);
            // dd( $request->all());

            $dataPassport = $request->only(['passport_number', 'issued_date', 'expiry_date']);
         
            $student->passport()->create($dataPassport);
            if(isset($request->subjects)){
                $student->subjects()->attach($request->subjects);
              
            }

            DB::commit();

            return redirect()->route('students.index')->with('success', 'Sinh viên đã được tạo.');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Log::error($e->getMessage());
            
            return redirect()->back()->withErrors('Tạo mới sinh viên fail.');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load('passport', 'classroom', 'subjects');
        return view('students.show', compact('student'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {

        $classrooms = Classroom::pluck('name', 'id');
        $subjects = Subject::select('id', 'name', 'credits')->get();

        $student->load('passport', 'classroom', 'subjects');
        return view('students.edit', compact('student', 'classrooms', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudentRequest $request, Student $student)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();

            $student->update($data);
            // dd( $request->all());

            $dataPassport = $request->only(['passport_number', 'issued_date', 'expiry_date']);
         
            if($student->passport){
                $student->passport()->update($dataPassport);
            }else{
                $student->passport()->create($dataPassport);
            }

            if(isset($request->subjects)){
                $student->subjects()->sync($request->subjects);
              
            }

            DB::commit();

            return redirect()->route('students.index')->with('success', 'Sinh viên đã được tạo.');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Log::error($e->getMessage());
            
            return redirect()->back()->withErrors('Tạo mới sinh viên fail.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
       DB::beginTransaction();
        try {
      
            $student->passport()->delete();

            $student->subjects()->detach();
            
            $student->delete();
            DB::commit();
            return back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); 
            dd($th->getMessage());
            return back()->with('error', 'Xóa Thất Bại');
        }
    }
}
