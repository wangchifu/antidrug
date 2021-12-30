@extends('layouts.master')

@section('content')
    <h3>
        <img src="{{ asset('images/icons/urine_work.png') }}" height="40">
        執行擴大尿篩工作填報資料管理
    </h3>
    <br>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('urine_screen_works.review') }}">上傳列表</a>
        </li>
        <li class="nav-item">

        </li>
    </ul>
    <form action="{{ route('urine_screen_works.search') }}" method="post">
        @csrf
        <table>
            <tr>
                <td>
                    <input type="date" class="form-control" name="date1" id="date1" value="{{ $date1 }}" maxlength="11" required>
                </td>
                <td>
                    <input type="date" class="form-control" name="date2" id="date2" value="{{ $date2 }}" maxlength="11" required>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="go_submit();"><i class="fas fa-recycle"></i> 切換查詢範圍</button>
                </td>
                <td>
                    <a class="btn btn-success btn-sm" href="{{ route('urine_screen_works.statistics',['date1'=>$date1,'date2'=>$date2]) }}" onclick="return confirm('下載 {{ $date1 }} 到 {{ $date2 }}')"><i class="fas fa-download"></i> {{ $date1 }} 到 {{ $date2 }}</a>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" class="form-control" name="want" id="want" placeholder="請輸入名稱" required>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i> 搜尋單位</button>
                </td>
                <td>

                </td>
            </tr>
        </table>
    </form>
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
                    <a href="{{ route('urine_screen_works.review_book',$urine_screen_work->id) }}" class="btn btn-outline-dark btn-sm">同意名冊</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        function go_submit(){
            date1 = $('#date1').val();
            date2 = $('#date2').val();
            window.location.href = '{{ url('review3/urine_screen_work/review/') }}'+'/'+date1+'/'+date2;
        }
    </script>
@endsection
