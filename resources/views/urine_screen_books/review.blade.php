@extends('layouts.master')

@section('content')
    <h3>
        <img src="{{ asset('images/icons/urine_book.png') }}" height="40">
        尿篩帳籍管制紀錄簿填報管理
    </h3>
    <br>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('urine_screen_books.review') }}">上傳列表</a>
        </li>
        <li class="nav-item">

        </li>
    </ul>
    <form action="{{ route('urine_screen_books.search') }}" method="post">
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
                    <a class="btn btn-success btn-sm" href="{{ route('urine_screen_books.statistics',['date1'=>$date1,'date2'=>$date2]) }}" onclick="return confirm('下載 {{ $date1 }} 到 {{ $date2 }}')"><i class="fas fa-download"></i> {{ $date1 }} 到 {{ $date2 }}</a>
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
            <th nowrap>日期</th>
            <th nowrap>單位</th>
            <th nowrap>試劑廠牌/種類</th>
            <th nowrap>領取/陰性/陽性/結餘</th>
            <th nowrap>備註</th>
        </tr>
        </thead>
        <tbody>
        @foreach($urine_screen_books as $urine_screen_book)
            <tr>
                <td nowrap>
                    {{ $urine_screen_book->date }}
                </td>
                <td nowrap>
                    @if(!empty($urine_screen_book->user->school_code))
                        {{ $schools[$urine_screen_book->user->school_code] }}
                    @else
                        {{ $urine_screen_book->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $urine_screen_book->created_at }}</small>
                </td>
                <td>
                    {{ $urine_screen_book->reagent_brand }} / {{ $urine_screen_book->reagent_type }}
                </td>
                <td nowrap>{{ $urine_screen_book->quantity }} / {{ $urine_screen_book->negative }} / <span class="text-danger">{{ $urine_screen_book->positive }}</span> / {{ $urine_screen_book->remain }}</td>
                <td>
                    {{ $urine_screen_book->note }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $urine_screen_books->links() }}
    <script>
        function go_submit(){
            date1 = $('#date1').val();
            date2 = $('#date2').val();
            window.location.href = '{{ url('review3/urine_screen_book/review/') }}'+'/'+date1+'/'+date2;
        }
    </script>
@endsection
