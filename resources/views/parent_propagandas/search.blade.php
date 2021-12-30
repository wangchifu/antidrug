@extends('layouts.master')

@section('content')
    <h3>
        <img src="{{ asset('images/icons/parents.png') }}" height="40">
        班親會…等向家長反毒宣導(一個學期兩次)管理
    </h3>
    <br>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('parent_propagandas.review') }}">上傳列表</a>
        </li>
        <li class="nav-item">

        </li>
    </ul>
    <form action="{{ route('parent_propagandas.search') }}" method="post">
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
                    <a class="btn btn-success btn-sm" href="{{ route('parent_propagandas.statistics',['date1'=>$date1,'date2'=>$date2]) }}" onclick="return confirm('下載 {{ $date1 }} 到 {{ $date2 }}')"><i class="fas fa-download"></i> {{ $date1 }} 到 {{ $date2 }}</a>
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
            <th>宣導日期</th>
            <th>單位</th>
            <th>宣導名稱</th>
            <th>照片</th>
        </tr>
        </thead>
        <tbody>
        @foreach($parent_propagandas as $parent_propaganda)
            <tr>
                <td>
                    {{ $parent_propaganda->date }}
                </td>
                <td>
                    @if(!empty($parent_propaganda->user->school_code))
                        {{ $schools[$parent_propaganda->user->school_code] }}
                    @else
                        {{ $parent_propaganda->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $parent_propaganda->created_at }}</small>
                </td>
                <td>
                    <a href="{{ route('parent_propagandas.show',$parent_propaganda->id) }}">
                        {{ $parent_propaganda->title }}
                    </a>
                </td>
                <td>{{ count($parent_propaganda->pics) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        function go_submit(){
            date1 = $('#date1').val();
            date2 = $('#date2').val();
            window.location.href = '{{ url('review1/parent_propaganda/review/') }}'+'/'+date1+'/'+date2;
        }
    </script>
@endsection
