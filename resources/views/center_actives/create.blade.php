@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('center_actives.index') }}">「反毒中心學校成果」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增資料</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/center.png') }}" height="40">
                反毒中心學校成果
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
            {{ Form::open(['route' => 'center_actives.store', 'method' => 'post', 'files' => true]) }}
                <div class="form-group">
                    <label for="title">活動主題<strong class="text-danger">*</strong></label>
                    <input type="text" class="form-control" name="title" id="title" required>
                </div>
            <div class="form-group">
                <label for="date">活動日期<strong class="text-danger">*</strong>
                </label>
                <input type="date" class="form-control" name="date" id="date" required maxlength="10" value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="place">活動地點<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="place" id="place" required>
            </div>
            <div class="form-group">
                <label for="person_times">參與人次<strong class="text-danger">*</strong>
                </label>
                <input type="number" class="form-control" name="person_times" id="person_times" required>
            </div>
            <div class="form-group">
                <label for="file">
                    成果檔案<strong class="text-danger">*</strong>
                    <small class="text-secondary">(請小於20MB)</small>
                </label>
                {{ Form::file('file', ['class' => 'form-control','required'=>'required']) }}
            </div>
            <div class="form-group">
                <label for="pics[]">
                    附圖<strong class="text-danger">*</strong>(用ctrl可多選)
                </label>
                {{ Form::file('pics[]', ['class' => 'form-control','multiple'=>'multiple','accept'=>'image/*','required'=>'required']) }}
            </div>
                <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-forward"></i> 儲存「反毒中心學校成果」並下一步填寫照片說明</button>
                <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            @include('layouts.form_errors')
        </div>
    </div>
@endsection
