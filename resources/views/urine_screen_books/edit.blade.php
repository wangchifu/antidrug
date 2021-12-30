@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('urine_screen_books.index') }}">「尿篩帳籍管制紀錄簿填報」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增資料</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/urine_book.png') }}" height="40">
                尿篩帳籍管制紀錄簿填報
            </h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>機關/單位/名稱</label><br>
                @if(!empty(auth()->user()->school_code))
                    {{ $schools[auth()->user()->school_code] }}
                @else
                    {{ auth()->user()->name }}
                @endif
            </div>
            {{ Form::open(['route' => ['urine_screen_books.update',$urine_screen_book->id], 'method' => 'post']) }}
            <div class="form-group">
                <label for="date">填報日期<strong class="text-danger">*</strong>
                </label>
                <input type="date" class="form-control" name="date" id="date" required maxlength="10" value="{{ $urine_screen_book->date }}">
            </div>
            <div class="form-group">
                <label for="reagent_brand">試劑廠牌<strong class="text-danger">*</strong></label><br>
                {{ Form::select('reagent_brand',$reagent_brands,$urine_screen_book->reagent_brand,['id'=>'reagent_brand','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label for="reagent_type">試劑種類<strong class="text-danger">*</strong></label><br>
                {{ Form::select('reagent_type',$reagent_types,$urine_screen_book->reagent_type,['id'=>'reagent_type','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label for="quantity">領取數量<strong class="text-danger">*</strong>
                </label>
                <input type="number" class="form-control" name="quantity" id="quantity" required value="{{ $urine_screen_book->quantity }}" onchange="total();">
            </div>
            <div class="form-group">
                <label for="negative">陰性人數<strong class="text-danger">*</strong>
                </label>
                <input type="number" class="form-control" name="negative" id="negative" required value="{{ $urine_screen_book->negative }}" onchange="total();">
            </div>
            <div class="form-group">
                <label for="positive">陽性人數<strong class="text-danger">*</strong>
                </label>
                <input type="number" class="form-control" name="positive" id="positive" required value="{{ $urine_screen_book->positive }}" onchange="total();">
            </div>
            <div class="form-group">
                <label for="remain">結餘<strong class="text-danger">*</strong>
                </label>
                <input type="number" class="form-control" name="remain" id="remain" required  value="{{ $urine_screen_book->remain }}" readonly>
            </div>
            <div class="form-group">
                <label for="note">備註</label>
                <input type="text" class="form-control" name="note" id="note" value="{{ $urine_screen_book->note }}">
            </div>
                <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-forward"></i> 儲存「尿篩帳籍管制紀錄簿」</button>
                <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            @include('layouts.form_errors')
        </div>
    </div>
    <script>
        function total(){
            document.getElementById('remain').value = $('#quantity').val()-$('#negative').val()-$('#positive').val();
        }
    </script>
@endsection
