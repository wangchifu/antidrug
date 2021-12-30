@extends('layouts.master')

@section('content')
    <h3>
        <img src="{{ asset('images/icons/monthly.png') }}" height="40">
        每月反毒宣導績效表填報管理
    </h3>
    <br>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('monthly_propagandas.review') }}">上傳列表</a>
        </li>
        <li class="nav-item">

        </li>
    </ul>
    <form action="{{ route('monthly_propagandas.search') }}" method="post">
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
                <a class="btn btn-success btn-sm" href="{{ route('monthly_propagandas.statistics',['date1'=>$date1,'date2'=>$date2]) }}" onclick="return confirm('下載 {{ $date1 }} 到 {{ $date2 }}')"><i class="fas fa-download"></i> {{ $date1 }} 到 {{ $date2 }}</a>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" class="form-control" name="want" id="want" placeholder="請輸入名稱" required value="{{ $want }}">
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
            <th nowrap>宣導日期</th>
            <th nowrap>單位</th>
            <th nowrap>名稱</th>
            <th nowrap>照片</th>
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
            </tr>
        @endforeach
        </tbody>
    </table>
    @yield('paginate')
    <script>
        function go_submit(){
            date1 = $('#date1').val();
            date2 = $('#date2').val();
            window.location.href = '{{ url('review1/monthly_propaganda/review/') }}'+'/'+date1+'/'+date2;
        }
    </script>
@endsection
