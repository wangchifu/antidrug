@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tzuchi_propagandas.index') }}">「慈濟宣導」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯資料</li>
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
            {{ Form::open(['route' => ['tzuchi_propagandas.update',$tzuchi_propaganda->id], 'method' => 'post', 'files' => true]) }}
            <div class="form-group">
                <label for="title">講題<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="title" id="title" required value="{{ $tzuchi_propaganda->title }}">
            </div>
            <div class="form-group">
                <label for="lecture">講師<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="lecture" id="lecture" required value="{{ $tzuchi_propaganda->lecture }}">
            </div>
            <div class="form-group">
                <label for="date">辦理日期時間<strong class="text-danger">*</strong></label>
                <input type="datetime-local" class="form-control" name="date" id="date" required maxlength="10" value="{{ $tzuchi_propaganda->date }}">
            </div>
            <div class="form-group">
                <label for="place">活動地點<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="place" id="place" required value="{{ $tzuchi_propaganda->place }}">
            </div>
            <div class="form-group">
                <label for="teacher_times">教師參加人數<strong class="text-danger">*</strong></label>
                <input type="number" class="form-control" name="teacher_times" id="teacher_times" required value="{{ $tzuchi_propaganda->teacher_times }}">
            </div>
            <div class="form-group">
                <label for="student_times">學生參加人數<strong class="text-danger">*</strong></label>
                <input type="number" class="form-control" name="student_times" id="student_times" required value="{{ $tzuchi_propaganda->student_times }}">
            </div>
            <div class="form-group">
                <label for="report">實施情形與效益評估<strong class="text-danger">*</strong></label>
                <textarea name="report" id="report" required class="form-control">{{ $tzuchi_propaganda->report }}</textarea>
            </div>
            <div class="form-group">
                <label for="content">檢討與建議<strong class="text-danger">*</strong></label>
                <textarea name="content" id="content" required class="form-control">{{ $tzuchi_propaganda->content }}</textarea>
            </div>
            <a name="pic_group"></a>
            <div class="form-group">
                <label>
                    已上傳的附圖
                </label>
                <div class="container">
                    <div class="row">
                        @foreach($pics as $pic)
                            @if(file_exists(storage_path('app/public/tzuchi_propagandas/'.$tzuchi_propaganda->id.'/'.$pic->pic)))
                                <div class="col-3" style="margin: 5px">
                                    <figure class="figure">
                                        <a href="{{ route('tzuchi_propagandas.del_pic',$pic->id) }}" onclick="return confirm('確定刪除？')"><i class="fas fa-times-circle text-danger"></i></a>
                                        <img src="{{ asset('storage/tzuchi_propagandas/'.$tzuchi_propaganda->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
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
            </div>
                <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-forward"></i> 儲存「慈濟宣導」</button>
                <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            @include('layouts.form_errors')
        </div>
    </div>
@endsection
