@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('center_actives.index') }}">「反毒中心學校成果」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯資料</li>
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
            {{ Form::open(['route' => ['center_actives.update',$center_active->id], 'method' => 'post', 'files' => true]) }}
            <div class="form-group">
                <label for="title">活動主題<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="title" id="title" required value="{{ $center_active->title }}">
            </div>
            <div class="form-group">
                <label for="date">活動日期<strong class="text-danger">*</strong>
                </label>
                <input type="date" class="form-control" name="date" id="date" required maxlength="10" value="{{ $center_active->date }}">
            </div>
            <div class="form-group">
                <label for="place">活動地點<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="place" id="place" required value="{{ $center_active->place }}">
            </div>
            <div class="form-group">
                <label for="person_times">參與人次<strong class="text-danger">*</strong>
                </label>
                <input type="number" class="form-control" name="person_times" id="person_times" required value="{{ $center_active->person_times }}">
            </div>
            <div class="form-group">
                <label>
                    已上傳的成果檔案
                </label>
                <div class="container">
                    <div class="row">
                        @if(file_exists(storage_path('app/public/center_actives/'.$center_active->id.'/'.$center_active->filename)))
                            <a href="{{ asset('storage/center_actives/'.$center_active->id.'/'.$center_active->filename) }}" target="_blank"><i class="fas fa-download text-primary"></i></a>
                        @else
                            檔案遺失 ({{ $center_active->filename }})<br>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="file">
                    成果檔案
                    <small class="text-secondary">(請小於20MB，上次再傳將覆蓋舊的)</small>
                </label>
                {{ Form::file('file', ['class' => 'form-control']) }}
            </div>
            <a name="pic_group"></a>
            <div class="form-group">
                <label>
                    已上傳的附圖
                </label>
                <div class="container">
                    <div class="row">
                        @foreach($pics as $pic)
                            @if(file_exists(storage_path('app/public/center_actives/'.$center_active->id.'/'.$pic->pic)))
                                <div class="col-3" style="margin: 5px">
                                    <figure class="figure">
                                        <a href="{{ route('center_actives.del_pic',$pic->id) }}" onclick="return confirm('確定刪除？')"><i class="fas fa-times-circle text-danger"></i></a>
                                        <img src="{{ asset('storage/center_actives/'.$center_active->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
                                        <figcaption class="figure-caption"><input type="text" placeholder="照片說明" name="pics_desc[{{ $pic->id }}]" value="{{ $pic->pic_desc }}"></figcaption>
                                    </figure>
                                </div>
                            @else
                                照片遺失 ({{ $pic->pic }})<br>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="pics[]">
                    增加附圖(用ctrl可多選)
                </label>
                {{ Form::file('pics[]', ['class' => 'form-control','multiple'=>'multiple','accept'=>'image/*']) }}
            </div>
            <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-forward"></i> 儲存「反毒中心學校成果」</button>
            <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            @include('layouts.form_errors')
        </div>
    </div>
@endsection
