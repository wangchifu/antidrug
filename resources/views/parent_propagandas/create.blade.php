@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('parent_propagandas.index') }}">「家長宣導」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增資料</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/parents.png') }}" height="40">
                家長藥物濫用防制知能研習(每學年一次)
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
            {{ Form::open(['route' => 'parent_propagandas.store', 'method' => 'post', 'files' => true]) }}
                <div class="form-group">
                    <label for="title">宣導主題<strong class="text-danger">*</strong></label>
                    <input type="text" class="form-control" name="title" id="title" required>
                </div>
            <div class="form-group">
                <label for="date">宣導日期<strong class="text-danger">*</strong>
                <small class="text-secondary">(若有多個場次，請輸入第一場次的日期)</small>
                </label>
                <input type="date" class="form-control" name="date" id="date" required maxlength="10" value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="object">宣導對象<strong class="text-danger">*</strong></label><br>
                {{ Form::select('object',$objects,null,['id'=>'object','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label for="type">宣導類別<strong class="text-danger">*</strong></label><br>
                {{ Form::select('type',$types,null,['id'=>'type','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label for="personnel">宣導人員<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="personnel" id="personnel" required>
            </div>
            <div class="form-group">
                <label for="place">宣導地點<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="place" id="place" required>
            </div>
            <div class="form-group">
                <label for="person_times">宣導人次<strong class="text-danger">*</strong>
                    <small class="text-secondary">(若有多個場次，請輸入加總人數)</small>
                </label>
                <input type="number" class="form-control" name="person_times" id="person_times" required>
            </div>
            <div class="form-group">
                <label for="times">宣導場次<strong class="text-danger">*</strong></label><br>
                {{ Form::select('times',$times,null,['id'=>'times','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label for="content">宣導內容<strong class="text-danger">*</strong></label>
                <textarea name="content" id="content" required class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="result">宣導成效<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="result" id="result" required>
            </div>
            <div class="form-group">
                <label for="money_source">經費來源</label>
                <input type="text" class="form-control" name="money_source" id="money_source">
            </div>
            <div class="form-group">
                <label for="money">經費總額</label>
                <input type="number" class="form-control" name="money" id="money">
            </div>
            <div class="form-group">
                <label for="pics[]">
                    附圖<strong class="text-danger">*</strong>(用ctrl可多選)
                </label>
                {{ Form::file('pics[]', ['class' => 'form-control','multiple'=>'multiple','accept'=>'image/*','required'=>'required']) }}
            </div>
                <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-forward"></i> 儲存「家長宣導」並下一步填寫照片說明</button>
                <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            @include('layouts.form_errors')
        </div>
    </div>
@endsection
