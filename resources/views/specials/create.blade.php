@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('specials.index') }}">「特定人員名冊」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增資料</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/special.png') }}" height="40">
                特定人員名冊(9月、3月開學填報)
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
            {{ Form::open(['route' => 'specials.store', 'method' => 'post','files' => true]) }}
            <div class="form-group">
                <label for="date">填報日期<strong class="text-danger">*</strong>
                </label>
                <input type="date" class="form-control" name="date" id="date" required maxlength="10" value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label>有無特定人員<strong class="text-danger">*</strong>
                </label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="yes_no" id="yes_no0" value="0" checked>
                    <label class="form-check-label" for="yes_no0">無</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="yes_no" id="yes_no1" value="1">
                    <label class="form-check-label" for="yes_no1">有</label>
                </div>
            </div>
            <div class="form-group">
                <label for="file">
                    會議紀錄
                </label>
                {{ Form::file('meeting', ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="file">
                    簽到表
                </label>
                {{ Form::file('signin', ['class' => 'form-control']) }}
            </div>
                <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-forward"></i> 儲存「特定人員名冊」，並繼續編輯特定人員名冊</button>
                <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            @include('layouts.form_errors')
        </div>
    </div>
@endsection
