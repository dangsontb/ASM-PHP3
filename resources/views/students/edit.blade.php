@extends('master')

@section('title')
    Cập nhật sinh viên {{ $student->name }}
@endsection

@section('content')
    <h1>Cập nhật sinh viên {{ $student->name }}</h1>

    
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

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên sinh viên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="classroom_id" class="form-label">Lớp học</label>
            <select class="form-control" id="classroom_id" name="classroom_id">
                <option value="">Chọn lớp học</option>
                @foreach ($classrooms as $id => $name)
                
                    <option value="{{ $id }}" {{  $student->classroom_id == $id ? 'selected' : '' }} >
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
                value="{{ $student->passport->passport_number }}">
            @error('passport_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="issued_date" class="form-label">Ngày cấp</label>
            <input type="date" class="form-control" id="issued_date" name="issued_date" value="{{ $student->passport->issued_date }}"
            >
            @error('issued_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="expiry_date" class="form-label">Ngày hết hạn</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ $student->passport->expiry_date }}"
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
                        {{ in_array($subject->id, $student->subjects->pluck('id')->toArray()) ? 'checked' : '' }}>
                        {{-- <input class="form-check-input" type="checkbox" name="subjects[]" value="{{ $subject->id }}"
                        id="subject{{ $subject->id }}"
                        {{ $student->subjects->contains($subject->id) ? 'checked' : '' }}> --}}
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
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
