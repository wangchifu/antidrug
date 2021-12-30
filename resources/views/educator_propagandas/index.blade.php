@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/teacher.png') }}" height="40">
                各校毒品防制宣導活動成果上傳(教育人員)
            </h5>
        </div>
        <div class="card-body">
            <a href="{{ route('educator_propagandas.create') }}" class="btn btn-success btn-sm">新增資料</a>
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
        @foreach($educator_propagandas as $educator_propaganda)
            <tr>
                <td>
                    {{ $educator_propaganda->date }}
                </td>
                <td>
                    @if(!empty($educator_propaganda->user->school_code))
                        {{ $schools[$educator_propaganda->user->school_code] }}
                    @else
                        {{ $educator_propaganda->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $educator_propaganda->created_at }}</small>
                </td>
                <td>
                    <a href="{{ route('educator_propagandas.show',$educator_propaganda->id) }}">
                        {{ $educator_propaganda->title }}
                    </a>
                </td>
                <td>{{ count($educator_propaganda->pics) }}</td>
                <td>
                    @if($educator_propaganda->user_id == auth()->user()->id)
                        <a href="{{ route('educator_propagandas.edit',$educator_propaganda->id) }}" class="btn btn-primary btn-sm">修改</a>
                        <a href="{{ route('educator_propagandas.destroy',$educator_propaganda->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @else
                        <small class="text-secondary">{{ $educator_propaganda->user->name }}</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $educator_propagandas->links() }}
@endsection
