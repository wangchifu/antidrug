@extends('layouts.master')

@section('content')
    <h3>
        <img src="{{ asset('images/icons/special.png') }}" height="40">
        特定人員名冊(9月、3月開學填報)管理
    </h3>
    <br>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('specials.review') }}">上傳列表</a>
        </li>
        <li class="nav-item">

        </li>
    </ul>
    <form action="{{ route('specials.search') }}" method="post">
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
                    <a class="btn btn-success btn-sm" href="{{ route('specials.statistics',['date1'=>$date1,'date2'=>$date2]) }}" onclick="return confirm('下載 {{ $date1 }} 到 {{ $date2 }}')"><i class="fas fa-download"></i> {{ $date1 }} 到 {{ $date2 }}</a>
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
                    <a href="{{ route('specials.review_book',$special->id) }}" class="btn btn-outline-dark btn-sm">人員與試劑名冊</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $specials->links() }}
    <script>
        function go_submit(){
            date1 = $('#date1').val();
            date2 = $('#date2').val();
            window.location.href = '{{ url('review3/special/review/') }}'+'/'+date1+'/'+date2;
        }
    </script>
@endsection
