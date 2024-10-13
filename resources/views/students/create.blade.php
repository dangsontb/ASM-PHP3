@extends('master')

@section('title')
    Thêm mới sinh viên
@endsection

@section('content')
    <h1>Thêm mới sinh viên</h1>

    
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

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên sinh viên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="classroom_id" class="form-label">Lớp học</label>
            <select class="form-control" id="classroom_id" name="classroom_id">
                <option value="">Chọn lớp học</option>
                @foreach ($classrooms as $id => $name)
                
                    <option value="{{ $id }}" {{  old('classroom_id') == $id ? 'selected' : '' }} >
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @error('classroom_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <h4 class="mt-4">Thông tin hộ chiếu</h4>

        <div class="mb-3">
            <label for="passport_number" class="form-label">Số hộ chiếu</label>
            <input type="text" class="form-control" id="passport_number" name="passport_number"
                value="{{ old('passport_number') }}">
            @error('passport_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="issued_date" class="form-label">Ngày cấp</label>
            <input type="date" class="form-control" id="issued_date" name="issued_date" value="{{ old('issued_date') }}"
            >
            @error('issued_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="expiry_date" class="form-label">Ngày hết hạn</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}"
            >
            @error('expiry_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <h4 class="mt-4">Môn học</h4>

        <div class="mb-3">
            @foreach ($subjects as $subject)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="subjects[]" value="{{ $subject->id }}"
                        id="subject{{ $subject->id }}"
                        {{ is_array(old('subjects')) && in_array($subject->id, old('subjects')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="subject{{ $subject->id }}">
                        {{ $subject->name }} ({{ $subject->credits }} tín chỉ)
                    </label>
                </div>
            @endforeach
            
            @error('subjects')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nút submit -->
        <button type="submit" class="btn btn-success">Thêm mới</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
