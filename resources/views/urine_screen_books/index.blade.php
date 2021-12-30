@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/urine_book.png') }}" height="40">
                尿篩帳籍管制紀錄簿填報
            </h5>
        </div>
        <div class="card-body">
            <a href="{{ route('urine_screen_books.create') }}" class="btn btn-success btn-sm">新增資料</a>
        </div>
    </div>
    <hr>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th nowrap>日期</th>
            <th nowrap>單位</th>
            <th nowrap>試劑廠牌/種類</th>
            <th nowrap>領取/陰性/陽性/結餘</th>
            <th nowrap>備註</th>
            <th nowrap>動作</th>
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
                <td>
                    @if($urine_screen_book->user_id == auth()->user()->id)
                        <a href="{{ route('urine_screen_books.edit',$urine_screen_book->id) }}" class="btn btn-primary btn-sm">修改</a>
                        <a href="{{ route('urine_screen_books.destroy',$urine_screen_book->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @else
                        <small class="text-secondary">{{ $urine_screen_book->user->name }}</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $urine_screen_books->links() }}
@endsection
