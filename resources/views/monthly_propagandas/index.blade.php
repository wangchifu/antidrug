@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/monthly.png') }}" height="40">
                每月反毒宣導績效表填報
            </h5>
        </div>
        <div class="card-body">
            <a href="{{ route('monthly_propagandas.create') }}" class="btn btn-success btn-sm">新增資料</a>
        </div>
    </div>
    <hr>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th nowrap>宣導日期</th>
            <th nowrap>單位</th>
            <th nowrap>名稱</th>
            <th nowrap>照片</th>
            <th nowrap>動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($monthly_propagandas as $monthly_propaganda)
            <tr>
                <td nowrap>
                    {{ $monthly_propaganda->date }}
                </td>
                <td>
                    @if(!empty($monthly_propaganda->user->school_code))
                        {{ $schools[$monthly_propaganda->user->school_code] }}
                    @else
                        {{ $monthly_propaganda->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $monthly_propaganda->created_at }}</small>
                </td>
                <td>
                    <a href="{{ route('monthly_propagandas.show',$monthly_propaganda->id) }}">
                        {{ $monthly_propaganda->title }}
                    </a>
                </td>
                <td>{{ count($monthly_propaganda->pics) }}</td>
                <td>
                    @if($monthly_propaganda->user_id == auth()->user()->id)
                        <a href="{{ route('monthly_propagandas.edit',$monthly_propaganda->id) }}" class="btn btn-primary btn-sm">修改</a>
                        <a href="{{ route('monthly_propagandas.destroy',$monthly_propaganda->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @else
                        <small class="text-secondary">{{ $monthly_propaganda->user->name }}</small>
                    @endif
                    @if(auth()->user()->admin==1)
                            <a href="{{ route('monthly_propagandas.destroy',$monthly_propaganda->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $monthly_propagandas->links() }}
@endsection
