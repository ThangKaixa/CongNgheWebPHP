@extends('layouts.app')

@section('title', 'Chỉnh sửa vấn đề')

@section('content')
    <h1 class="mb-4">Chỉnh sửa vấn đề</h1>

    <form action="{{ route('issues.update', $issue->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="computer_id" class="form-label">Chọn máy tính</label>
            <select name="computer_id" id="computer_id" class="form-select">
                @foreach ($computers as $computer)
                    <option value="{{ $computer->id }}" {{ $computer->id == $issue->computer_id ? 'selected' : '' }}>
                        {{ $computer->computer_name }} - {{ $computer->model }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="reported_by" class="form-label">Người báo cáo</label>
            <input type="text" name="reported_by" id="reported_by" class="form-control" value="{{ $issue->reported_by }}">
        </div>

        <div class="mb-3">
            <label for="reported_date" class="form-label">Thời gian báo cáo</label>
            <input type="datetime-local" name="reported_date" id="reported_date" class="form-control" value="{{ $issue->reported_date }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả vấn đề</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ $issue->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="urgency" class="form-label">Mức độ</label>
            <select name="urgency" id="urgency" class="form-select">
                <option value="Low" {{ $issue->urgency == 'Low' ? 'selected' : '' }}>Thấp</option>
                <option value="Medium" {{ $issue->urgency == 'Medium' ? 'selected' : '' }}>Trung bình</option>
                <option value="High" {{ $issue->urgency == 'High' ? 'selected' : '' }}>Cao</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" id="status" class="form-select">
                <option value="Open" {{ $issue->status == 'Open' ? 'selected' : '' }}>Mở</option>
                <option value="In Progress" {{ $issue->status == 'In Progress' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="Resolved" {{ $issue->status == 'Resolved' ? 'selected' : '' }}>Đã giải quyết</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('issues.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
