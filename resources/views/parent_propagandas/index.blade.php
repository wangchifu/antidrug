@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/parents.png') }}" height="40">
                家長藥物濫用防制知能研習(每年度一次)
            </h5>
        </div>
        <div class="card-body">
            <a href="{{ route('parent_propagandas.create') }}" class="btn btn-success btn-sm">新增資料</a>
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
        @foreach($parent_propagandas as $parent_propaganda)
            <tr>
                <td>
                    {{ $parent_propaganda->date }}
                </td>
                <td>
                    @if(!empty($parent_propaganda->user->school_code))
                        {{ $schools[$parent_propaganda->user->school_code] }}
                    @else
                        {{ $parent_propaganda->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $parent_propaganda->created_at }}</small>
                </td>
                <td>
                    <a href="{{ route('parent_propagandas.show',$parent_propaganda->id) }}">
                        {{ $parent_propaganda->title }}
                    </a>
                </td>
                <td>{{ count($parent_propaganda->pics) }}</td>
                <td>
                    @if($parent_propaganda->user_id == auth()->user()->id)
                        <a href="{{ route('parent_propagandas.edit',$parent_propaganda->id) }}" class="btn btn-primary btn-sm">修改</a>
                        <a href="{{ route('parent_propagandas.destroy',$parent_propaganda->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @else
                        <small class="text-secondary">{{ $parent_propaganda->user->name }}</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $parent_propagandas->links() }}
@endsection
