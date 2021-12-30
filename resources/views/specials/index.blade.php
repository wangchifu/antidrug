@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/special.png') }}" height="40">
                特定人員名冊(9月、3月開學填報)
            </h5>
        </div>
        <div class="card-body">
            <a href="{{ route('specials.create') }}" class="btn btn-success btn-sm">新增資料</a>
        </div>
    </div>
    <hr>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th nowrap>填報日期</th>
            <th nowrap>單位</th>
            <th nowrap>特定人員</th>
            <th nowrap>會議紀錄</th>
            <th nowrap>簽到表</th>
            <th nowrap>人員總數</th>
            <th nowrap>動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($specials as $special)
            <tr>
                <td nowrap>
                    {{ $special->date }}
                </td>
                <td>
                    @if(!empty($special->user->school_code))
                        {{ $schools[$special->user->school_code] }}
                    @else
                        {{ $special->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $special->created_at }}</small>
                </td>
                <td>
                    @if($special->yes_no==0)
                        否
                    @elseif($special->yes_no==1)
                        是
                    @endif
                </td>
                <td>
                    @if(!empty($special->meeting_filename))
                        @if(file_exists(storage_path('app/privacy/specials/'.$special->id.'/'.$special->meeting_filename)))
                            <a href="{{ route('specials.open',[$special->id,'meeting']) }}" target="_blank"><i class="fas fa-download text-primary"></i></a>
                        @else
                            檔案遺失
                        @endif
                    @endif
                </td>
                <td>
                    @if(!empty($special->signin_filename))
                        @if(file_exists(storage_path('app/privacy/specials/'.$special->id.'/'.$special->signin_filename)))
                            <a href="{{ route('specials.open',[$special->id,'signin']) }}" target="_blank"><i class="fas fa-download text-primary"></i></a>
                        @else
                            檔案遺失
                        @endif
                    @endif
                </td>
                <td>
                    {{ count($special->members) }}
                </td>
                <td>
                    @if($special->user_id == auth()->user()->id)
                        <a href="{{ route('specials.agree',$special->id) }}" class="btn btn-outline-dark btn-sm">編輯特定人員名冊</a>
                        <a href="{{ route('specials.reagent',$special->id) }}" class="btn btn-outline-secondary btn-sm">編輯快速檢驗試劑名冊</a><br>
                        <a href="{{ route('specials.edit',$special->id) }}" class="btn btn-primary btn-sm">修改</a>
                        <a href="{{ route('specials.destroy',$special->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @else
                        <small class="text-secondary">{{ $special->user->name }}</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $specials->links() }}
@endsection
