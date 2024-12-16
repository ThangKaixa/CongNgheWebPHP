@extends('layouts.app')

@section('title', 'Danh sách vấn đề')

@section('content')
    <h1 class="mb-4">Danh sách vấn đề</h1>

    <a href="{{ route('issues.create') }}" class="btn btn-primary mb-3">Thêm vấn đề mới</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Mã vấn đề</th>
                <th>Tên máy tính</th>
                <th>Tên phiên bản</th>
                <th>Người báo cáo</th>
                <th>Thời gian báo cáo</th>
                <th>Mức độ</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($issues as $issue)
                <tr>
                    <td>{{ $issue->id }}</td>
                    <td>{{ $issue->computer->computer_name }}</td>
                    <td>{{ $issue->computer->model }}</td>
                    <td>{{ $issue->reported_by }}</td>
                    <td>{{ $issue->reported_date }}</td>
                    <td>{{ $issue->urgency }}</td>
                    <td>{{ $issue->status }}</td>
                    <td>
                        <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('issues.destroy', $issue->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Không có vấn đề nào!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
