@extends('layouts.master')

@section('content')
    <h3>
        <img src="{{ asset('images/icons/center.png') }}" height="40">
        反毒中心學校成果管理
    </h3>
    <br>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('center_actives.review') }}">上傳列表</a>
        </li>
        <li class="nav-item">

        </li>
    </ul>
    <form action="{{ route('center_actives.search') }}" method="post">
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
                    <a class="btn btn-success btn-sm" href="{{ route('center_actives.statistics',['date1'=>$date1,'date2'=>$date2]) }}" onclick="return confirm('下載 {{ $date1 }} 到 {{ $date2 }}')"><i class="fas fa-download"></i> {{ $date1 }} 到 {{ $date2 }}</a>
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
            <th nowrap>活動日期</th>
            <th nowrap>單位</th>
            <th nowrap>活動名稱</th>
            <th nowrap>成果</th>
            <th nowrap>照片</th>
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
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        function go_submit(){
            date1 = $('#date1').val();
            date2 = $('#date2').val();
            window.location.href = '{{ url('review2/center_active/review/') }}'+'/'+date1+'/'+date2;
        }
    </script>
@endsection
