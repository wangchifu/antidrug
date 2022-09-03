@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('other_propagandas.index') }}">「毒品危害防治宣導(其他)」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯資料</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/other.png') }}" height="40">
                學校辦理戒毒成功專線宣導(一年一次)
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
            {{ Form::open(['route' => ['other_propagandas.update',$other_propaganda->id], 'method' => 'post', 'files' => true]) }}
            <div class="form-group">
                <label for="title">宣導主題<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="title" id="title" required value="{{ $other_propaganda->title }}">
            </div>
            <div class="form-group">
                <label for="date">宣導日期<strong class="text-danger">*</strong>
                    <small class="text-secondary">(若有多個場次，請輸入第一場次的日期)</small>
                </label>
                <input type="date" class="form-control" name="date" id="date" required maxlength="10" value="{{ $other_propaganda->date }}">
            </div>
            <div class="form-group">
                <label for="object">宣導對象<strong class="text-danger">*</strong></label><br>
                {{ Form::select('object',$objects,$other_propaganda->object,['id'=>'object','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label for="type">宣導類別<strong class="text-danger">*</strong></label><br>
                {{ Form::select('type',$types,$other_propaganda->type,['id'=>'type','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label for="personnel">宣導人員<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="personnel" id="personnel" required value="{{ $other_propaganda->personnel }}">
            </div>
            <div class="form-group">
                <label for="place">宣導地點<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="place" id="place" required value="{{ $other_propaganda->place }}">
            </div>
            <div class="form-group">
                <label for="person_times">宣導人次<strong class="text-danger">*</strong>
                <small class="text-secondary">(若有多個場次，請輸入加總人數)</small>
                </label>
                <input type="number" class="form-control" name="person_times" id="person_times" required value="{{ $other_propaganda->person_times }}">
            </div>
            <div class="form-group">
                <label for="times">宣導場次<strong class="text-danger">*</strong></label><br>
                {{ Form::select('times',$times,$other_propaganda->times,['id'=>'times','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label for="content">宣導內容<strong class="text-danger">*</strong></label>
                <textarea name="content" id="content" required class="form-control">{{ $other_propaganda->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="result">宣導成效<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="result" id="result" required value="{{ $other_propaganda->result }}">
            </div>
            <div class="form-group">
                <label for="money_source">經費來源</label>
                <input type="text" class="form-control" name="money_source" id="money_source" value="{{ $other_propaganda->money_source }}">
            </div>
            <div class="form-group">
                <label for="money">經費總額</label>
                <input type="number" class="form-control" name="money" id="money" value="{{ $other_propaganda->money }}">
            </div>
            <a name="pic_group"></a>
            <div class="form-group">
                <label>
                    已上傳的附圖
                </label>
                <div class="container">
                    <div class="row">
                        @foreach($pics as $pic)
                            @if(file_exists(storage_path('app/public/other_propagandas/'.$other_propaganda->id.'/'.$pic->pic)))
                                <div class="col-3" style="margin: 5px">
                                    <figure class="figure">
                                        <a href="{{ route('other_propagandas.del_pic',$pic->id) }}" onclick="return confirm('確定刪除？')"><i class="fas fa-times-circle text-danger"></i></a>
                                        <img src="{{ asset('storage/other_propagandas/'.$other_propaganda->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
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
            <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-forward"></i> 儲存「戒毒成功專線宣導」</button>
            <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            @include('layouts.form_errors')
        </div>
    </div>
@endsection
