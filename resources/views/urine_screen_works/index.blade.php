@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/urine_work.png') }}" height="40">
                執行擴大尿篩工作填報資料
            </h5>
        </div>
        <div class="card-body">
            <a href="{{ route('urine_screen_works.create') }}" class="btn btn-success btn-sm">新增資料</a>
        </div>
    </div>
    <hr>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th nowrap>調查<br>日期</th>
            <th nowrap>單位</th>
            <th nowrap>快篩陽性</th>
            <th nowrap>確認<br>快篩陽性</th>
            <th nowrap>是否成立<br>春暉小組</th>
            <th nowrap>檢驗<br>名冊</th>
            <th nowrap>備註</th>
            <th nowrap>動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($urine_screen_works as $urine_screen_work)
            <tr>
                <td nowrap>
                    {{ $urine_screen_work->date }}
                </td>
                <td nowrap>
                    @if(!empty($urine_screen_work->user->school_code))
                        {{ $schools[$urine_screen_work->user->school_code] }}
                    @else
                        {{ $urine_screen_work->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $urine_screen_work->created_at }}</small>
                </td>
                <td nowrap>
                    男：{{ $urine_screen_work->positive_boy }}<br>
                    女：{{ $urine_screen_work->positive_girl }}
                </td>
                <td nowrap>
                    男：{{ $urine_screen_work->confirm_positive_boy }}<br>
                    女：{{ $urine_screen_work->confirm_positive_girl }}
                </td>
                <td>
                    @if($urine_screen_work->chun_hui==0)
                        否
                    @elseif($urine_screen_work->chun_hui==1)
                        是
                    @endif
                </td>
                <td>
                    @if(!empty($urine_screen_work->filename))
                        @if(file_exists(storage_path('app/privacy/urine_screen_works/'.$urine_screen_work->id.'/'.$urine_screen_work->filename)))
                            <a href="{{ route('urine_screen_works.open',$urine_screen_work->id) }}" target="_blank"><i class="fas fa-download text-primary"></i></a>
                        @else
                            檔案遺失
                        @endif
                    @endif
                </td>
                <td>
                    {{ $urine_screen_work->note }}
                </td>
                <td>
                    @if($urine_screen_work->user_id == auth()->user()->id)
                        <a href="{{ route('urine_screen_works.agree',$urine_screen_work->id) }}" class="btn btn-success btn-sm">編輯同意名冊</a>
                        <a href="{{ route('urine_screen_works.edit',$urine_screen_work->id) }}" class="btn btn-primary btn-sm">修改</a>
                        <a href="{{ route('urine_screen_works.destroy',$urine_screen_work->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @else
                        <small class="text-secondary">{{ $urine_screen_work->user->name }}</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $urine_screen_works->links() }}
@endsection
