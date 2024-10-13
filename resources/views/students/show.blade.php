@extends('master')

@section('title')
    Thông tin sinh viên: {{ $student->name }}
@endsection

@section('content')
    <h1>Thông tin sinh viên: {{ $student->name }}</h1>


    
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

    <table class="table table-bordered">
        <tr>
            <th>Tên</th>
            <td>{{ $student->name }}</td>
        </tr>

        <tr>
            <th>Email</th>
            <td>{{ $student->email }}</td>
        </tr>

        <tr>
            <th>Lớp học</th>
            <td>{{ $student->classroom->name }}</td>
        </tr>

        <tr>
            <th>Giáo viên phụ trách</th>
            <td>{{ $student->classroom->teacher_name }}</td>
        </tr>

        <tr>
            <th>Số hộ chiếu</th>
            <td>{{ $student->passport->passport_number }}</td>
        </tr>

        <tr>
            <th>Ngày cấp chiếu</th>
            <td>{{ $student->passport->issued_date }}</td>
        </tr>

        <tr>
            <th>Ngày hết hạn chiếu</th>
            <td>{{ $student->passport->expiry_date }}</td>
        </tr>

        <tr>
            <th>Môn học</th>
            <th>Số tín chỉ</th>
        <tr>
            @foreach ($student->subjects as $subject)
        <tr>
            <td>{{ $subject->name }}</td>
            <td>{{ $subject->credits }}</td>
        </tr>
        @endforeach
        </tr>
        </tr>

    </table>
@endsection
