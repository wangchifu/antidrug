@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/tzuchi.png') }}" height="40">
                慈濟無毒有我宣導活動成果上傳
            </h5>
        </div>
        <div class="card-body">
            <a href="{{ route('tzuchi_propagandas.create') }}" class="btn btn-success btn-sm">新增資料</a>
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
        @foreach($tzuchi_propagandas as $tzuchi_propaganda)
            <tr>
                <td>
                    {{ $tzuchi_propaganda->date }}
                </td>
                <td>
                    @if(!empty($tzuchi_propaganda->user->school_code))
                        {{ $schools[$tzuchi_propaganda->user->school_code] }}
                    @else
                        {{ $tzuchi_propaganda->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $tzuchi_propaganda->created_at }}</small>
                </td>
                <td>
                    <a href="{{ route('tzuchi_propagandas.show',$tzuchi_propaganda->id) }}">
                        {{ $tzuchi_propaganda->title }}
                    </a>
                </td>
                <td>{{ count($tzuchi_propaganda->pics) }}</td>
                <td>
                    @if($tzuchi_propaganda->user_id == auth()->user()->id)
                        <a href="{{ route('tzuchi_propagandas.edit',$tzuchi_propaganda->id) }}" class="btn btn-primary btn-sm">修改</a>
                        <a href="{{ route('tzuchi_propagandas.destroy',$tzuchi_propaganda->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @else
                        <small class="text-secondary">{{ $tzuchi_propaganda->user->name }}</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $tzuchi_propagandas->links() }}
@endsection
