@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/center.png') }}" height="40">
                反毒中心學校成果
            </h5>
        </div>
        <div class="card-body">
            <a href="{{ route('center_actives.create') }}" class="btn btn-success btn-sm">新增資料</a>
        </div>
    </div>
    <hr>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th nowrap>活動日期</th>
            <th nowrap>單位</th>
            <th nowrap>活動名稱</th>
            <th nowrap>成果</th>
            <th nowrap>照片</th>
            <th nowrap>動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($center_actives as $center_active)
            <tr>
                <td nowrap>
                    {{ $center_active->date }}
                </td>
                <td>
                    @if(!empty($center_active->user->school_code))
                        {{ $schools[$center_active->user->school_code] }}
                    @else
                        {{ $center_active->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $center_active->created_at }}</small>
                </td>
                <td>
                    <a href="{{ route('center_actives.show',$center_active->id) }}">
                        {{ $center_active->title }}
                    </a>
                </td>
                <td>
                    @if(!empty($center_active->filename))
                        @if(file_exists(storage_path('app/public/center_actives/'.$center_active->id.'/'.$center_active->filename)))
                            <a href="{{ asset('storage/center_actives/'.$center_active->id.'/'.$center_active->filename) }}" target="_blank"><i class="fas fa-download text-primary"></i></a>
                        @else
                            檔案遺失
                        @endif
                    @endif
                </td>
                <td>{{ count($center_active->pics) }}</td>
                <td>
                    @if($center_active->user_id == auth()->user()->id)
                        <a href="{{ route('center_actives.edit',$center_active->id) }}" class="btn btn-primary btn-sm">修改</a>
                        <a href="{{ route('center_actives.destroy',$center_active->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @else
                        <small class="text-secondary">{{ $center_active->user->name }}</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $center_actives->links() }}
@endsection
