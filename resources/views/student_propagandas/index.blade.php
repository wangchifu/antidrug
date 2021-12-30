@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/student.png') }}" height="40">
                各校毒品防制宣導活動成果上傳(學生)
            </h5>
        </div>
        <div class="card-body">
            <a href="{{ route('student_propagandas.create') }}" class="btn btn-success btn-sm">新增資料</a>
        </div>
    </div>
    <hr>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th>宣導日期</th>
            <th>單位</th>
            <th>宣導名稱</th>
            <th>照片</th>
            <th>動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($student_propagandas as $student_propaganda)
            <tr>
                <td>
                    {{ $student_propaganda->date }}
                </td>
                <td>
                    @if(!empty($student_propaganda->user->school_code))
                        {{ $schools[$student_propaganda->user->school_code] }}
                    @else
                        {{ $student_propaganda->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $student_propaganda->created_at }}</small>
                </td>
                <td>
                    <a href="{{ route('student_propagandas.show',$student_propaganda->id) }}">
                        {{ $student_propaganda->title }}
                    </a>
                </td>
                <td>{{ count($student_propaganda->pics) }}</td>
                <td>
                    @if($student_propaganda->user_id == auth()->user()->id)
                        <a href="{{ route('student_propagandas.edit',$student_propaganda->id) }}" class="btn btn-primary btn-sm">修改</a>
                        <a href="{{ route('student_propagandas.destroy',$student_propaganda->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @else
                        <small class="text-secondary">{{ $student_propaganda->user->name }}</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $student_propagandas->links() }}
@endsection
