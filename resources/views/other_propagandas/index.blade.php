@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/other.png') }}" height="40">
                毒品危害防治宣導(其他)
            </h5>
        </div>
        <div class="card-body">
            <a href="{{ route('other_propagandas.create') }}" class="btn btn-success btn-sm">新增資料</a>
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
        @foreach($other_propagandas as $other_propaganda)
            <tr>
                <td>
                    {{ $other_propaganda->date }}
                </td>
                <td>
                    @if(!empty($other_propaganda->user->school_code))
                        {{ $schools[$other_propaganda->user->school_code] }}
                    @else
                        {{ $other_propaganda->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $other_propaganda->created_at }}</small>
                </td>
                <td>
                    <a href="{{ route('other_propagandas.show',$other_propaganda->id) }}">
                        {{ $other_propaganda->title }}
                    </a>
                </td>
                <td>{{ count($other_propaganda->pics) }}</td>
                <td>
                    @if($other_propaganda->user_id == auth()->user()->id)
                        <a href="{{ route('other_propagandas.edit',$other_propaganda->id) }}" class="btn btn-primary btn-sm">修改</a>
                        <a href="{{ route('other_propagandas.destroy',$other_propaganda->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @else
                        <small class="text-secondary">{{ $other_propaganda->user->name }}</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $other_propagandas->links() }}
@endsection
