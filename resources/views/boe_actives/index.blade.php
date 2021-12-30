@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/boe.png') }}" height="40">
                教育處自辦活動成果
            </h5>
        </div>
        <div class="card-body">
            <a href="{{ route('boe_actives.create') }}" class="btn btn-success btn-sm">新增資料</a>
        </div>
    </div>
    <hr>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th>活動日期</th>
            <th>單位</th>
            <th>活動名稱</th>
            <th>照片</th>
            <th>動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($boe_actives as $boe_active)
            <tr>
                <td>
                    {{ $boe_active->date }}
                </td>
                <td>
                    @if(!empty($boe_active->user->school_code))
                        {{ $schools[$boe_active->user->school_code] }}
                    @else
                        {{ $boe_active->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $boe_active->created_at }}</small>
                </td>
                <td>
                    <a href="{{ route('boe_actives.show',$boe_active->id) }}">
                        {{ $boe_active->title }}
                    </a>
                </td>
                <td>{{ count($boe_active->pics) }}</td>
                <td>
                    @if($boe_active->user_id == auth()->user()->id)
                        <a href="{{ route('boe_actives.edit',$boe_active->id) }}" class="btn btn-primary btn-sm">修改</a>
                        <a href="{{ route('boe_actives.destroy',$boe_active->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @else
                        <small class="text-secondary">{{ $boe_active->user->name }}</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $boe_actives->links() }}
@endsection
