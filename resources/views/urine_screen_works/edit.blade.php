@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('urine_screen_works.index') }}">「執行擴大尿篩工作填報」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增資料</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/urine_work.png') }}" height="40">
                執行擴大尿篩工作填報資料
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
            {{ Form::open(['route' => ['urine_screen_works.update',$urine_screen_work->id], 'method' => 'post','files' => true]) }}
            <div class="form-group">
                <label for="date">調查日期<strong class="text-danger">*</strong>
                </label>
                <input type="date" class="form-control" name="date" id="date" required maxlength="10" value="{{ $urine_screen_work->date }}">
            </div>
            <div class="form-group">
                <label for="positive_boy">快篩陽性(男)<strong class="text-danger">*</strong>
                </label>
                <input type="number" class="form-control" name="positive_boy" id="positive_boy" required value="{{ $urine_screen_work->positive_boy }}">
            </div>
            <div class="form-group">
                <label for="positive_girl">快篩陽性(女)<strong class="text-danger">*</strong>
                </label>
                <input type="number" class="form-control" name="positive_girl" id="positive_girl" required value="{{ $urine_screen_work->positive_girl }}">
            </div>
            <div class="form-group">
                <label for="confirm_positive_boy">確認快篩陽性(男)<strong class="text-danger">*</strong>
                </label>
                <input type="number" class="form-control" name="confirm_positive_boy" id="confirm_positive_boy" required value="{{ $urine_screen_work->confirm_positive_boy }}">
            </div>
            <div class="form-group">
                <label for="confirm_positive_girl">確認快篩陽性(女)<strong class="text-danger">*</strong>
                </label>
                <input type="number" class="form-control" name="confirm_positive_girl" id="confirm_positive_girl" required value="{{ $urine_screen_work->confirm_positive_girl }}">
            </div>
            <div class="form-group">
                <label>是否成立春暉小組<strong class="text-danger">*</strong>
                </label><br>
                <?php
                    $radio0 = ($urine_screen_work->chun_hui==0)?"checked":"";
                    $radio1 = ($urine_screen_work->chun_hui==1)?"checked":"";
                ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="chun_hui" id="chun_hui0" value="0" {{ $radio0 }}>
                    <label class="form-check-label" for="chun_hui0">否</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="chun_hui" id="chun_hui1" value="1" {{ $radio1 }}>
                    <label class="form-check-label" for="chun_hui1">是</label>
                </div>
            </div>
            <div class="form-group">
                <label>
                    已上傳的檢驗名冊檔案
                </label>
                <div class="container">
                    <div class="row">
                        @if(file_exists(storage_path('app/privacy/urine_screen_works/'.$urine_screen_work->id.'/'.$urine_screen_work->filename)))
                            <a href="{{ route('urine_screen_works.open',$urine_screen_work->id) }}" target="_blank"><i class="fas fa-download text-primary"></i></a>
                        @else
                            檔案遺失 ({{ $urine_screen_work->filename }})<br>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="file">
                    檢驗名冊檔案
                    <small class="text-secondary">(限 PDF 檔)</small>
                </label>
                {{ Form::file('file', ['class' => 'form-control','accept'=>'.pdf']) }}
            </div>
            <div class="form-group">
                <label for="note">備註</label>
                <input type="text" class="form-control" name="note" id="note" value="{{ $urine_screen_work->note }}">
            </div>
                <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-forward"></i> 儲存「執行擴大尿篩工作填報」</button>
                <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            @include('layouts.form_errors')
        </div>
    </div>
@endsection
