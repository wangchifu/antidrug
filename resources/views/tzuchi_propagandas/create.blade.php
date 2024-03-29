@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tzuchi_propagandas.index') }}">「慈濟宣導」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增資料</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/tzuchi.png') }}" height="40">
                慈濟無毒有我宣導活動成果上傳
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
            {{ Form::open(['route' => 'tzuchi_propagandas.store', 'method' => 'post', 'files' => true]) }}
            <div class="form-group">
                <label for="title">講題<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="lecture">講師<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="lecture" id="lecture" required>
            </div>
            <div class="form-group">
                <label for="date">辦理日期時間<strong class="text-danger">*</strong></label>
                <input type="datetime-local" class="form-control" name="date" id="date" required maxlength="10" value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="place">活動地點<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="place" id="place" required>
            </div>
            <div class="form-group">
                <label for="teacher_times">教師參加人數<strong class="text-danger">*</strong></label>
                <input type="number" class="form-control" name="teacher_times" id="teacher_times" required onFocus="if(this.value=='0')this.value='';" onBlur="if(this.value=='')this.value='0';" value="0">
            </div>
            <div class="form-group">
                <label for="student_times">學生參加人數<strong class="text-danger">*</strong></label>
                <input type="number" class="form-control" name="student_times" id="student_times" required onFocus="if(this.value=='0')this.value='';" onBlur="if(this.value=='')this.value='0';" value="0">
            </div>
            <div class="form-group">
                <label for="report">實施情形與效益評估<strong class="text-danger">*</strong></label>
                <textarea name="report" id="report" required class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="content">檢討與建議<strong class="text-danger">*</strong></label>
                <textarea name="content" id="content" required class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="pics[]">
                    附圖<strong class="text-danger">*</strong>(用ctrl可多選)
                </label>
                {{ Form::file('pics[]', ['class' => 'form-control','multiple'=>'multiple','accept'=>'image/*','required'=>'required']) }}
            </div>
                <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-forward"></i> 儲存「慈濟宣導」並下一步填寫照片說明</button>
                <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            @include('layouts.form_errors')
        </div>
    </div>
@endsection
