@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('boe_actives.index') }}">「教育處自辦活動成果」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯資料</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/boe.png') }}" height="40">
                教育處自辦活動成果
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
            {{ Form::open(['route' => ['boe_actives.update',$boe_active->id], 'method' => 'post', 'files' => true]) }}
            <div class="form-group">
                <label for="title">活動主題<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="title" id="title" required value="{{ $boe_active->title }}">
            </div>
            <div class="form-group">
                <label for="date">活動日期<strong class="text-danger">*</strong>
                    <small class="text-secondary">(若有多個場次，請輸入第一場次的日期)</small>
                </label>
                <input type="date" class="form-control" name="date" id="date" required maxlength="10" value="{{ $boe_active->date }}">
            </div>
            <div class="form-group">
                <label for="object">活動對象<strong class="text-danger">*</strong></label><br>
                {{ Form::select('object',$objects,$boe_active->object,['id'=>'object','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label for="type">活動類別<strong class="text-danger">*</strong></label><br>
                {{ Form::select('type',$types,$boe_active->type,['id'=>'type','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label for="personnel">宣導人員<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="personnel" id="personnel" required value="{{ $boe_active->personnel }}">
            </div>
            <div class="form-group">
                <label for="place">活動地點<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="place" id="place" required value="{{ $boe_active->place }}">
            </div>
            <div class="form-group">
                <label for="person_times">參與人次<strong class="text-danger">*</strong>
                <small class="text-secondary">(若有多個場次，請輸入加總人數)</small>
                </label>
                <input type="number" class="form-control" name="person_times" id="person_times" required value="{{ $boe_active->person_times }}">
            </div>
            <div class="form-group">
                <label for="times">活動場次<strong class="text-danger">*</strong></label><br>
                {{ Form::select('times',$times,$boe_active->times,['id'=>'times','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label for="content">活動內容<strong class="text-danger">*</strong></label>
                <textarea name="content" id="content" required class="form-control">{{ $boe_active->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="result">活動成效<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="result" id="result" required value="{{ $boe_active->result }}">
            </div>
            <div class="form-group">
                <label for="money_source">經費來源</label>
                <input type="text" class="form-control" name="money_source" id="money_source" value="{{ $boe_active->money_source }}">
            </div>
            <div class="form-group">
                <label for="money">經費總額</label>
                <input type="number" class="form-control" name="money" id="money" value="{{ $boe_active->money }}">
            </div>
            <a name="pic_group"></a>
            <div class="form-group">
                <label>
                    已上傳的附圖
                </label>
                <div class="container">
                    <div class="row">
                        @foreach($pics as $pic)
                            @if(file_exists(storage_path('app/public/boe_actives/'.$boe_active->id.'/'.$pic->pic)))
                                <div class="col-3" style="margin: 5px">
                                    <figure class="figure">
                                        <a href="{{ route('boe_actives.del_pic',$pic->id) }}" onclick="return confirm('確定刪除？')"><i class="fas fa-times-circle text-danger"></i></a>
                                        <img src="{{ asset('storage/boe_actives/'.$boe_active->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
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
            <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-forward"></i> 儲存「教育處自辦活動成果」</button>
            <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            @include('layouts.form_errors')
        </div>
    </div>
@endsection
