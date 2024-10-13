@extends('master')

@section('title')
    Danh sách sinh viên
@endsection

@section('content')
    <h1>Danh sách sinh viên</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{ session('success') }}</strong> 
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            <strong>{{ session('error') }}</strong> 
        </div>
    @endif
    
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('students.create') }}" class="btn btn-primary">Thêm sinh viên mới</a>
        <form action="{{ route('students.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..."
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary ms-2">Tìm</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Lớp học</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $student)
                <tr>
                    <th></th>
                    <th>{{ $student->id }}</th>
                    <th>{{ $student->name }}</th>
                    <th>{{ $student->email }}</th>
                    <th>{{ $student->classroom->name }}</th>
                    <th>
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">SHOW</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">EDIT</a>

                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('bạn có muốn xóa ?')" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center">
        {{ $data->appends(['search' => $search])->links() }}
    </div>
@endsection
