@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('title_images.index') }}">「標題圖片」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">修改標題圖片</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header text-center">
            <h3 class="py-2">
                修改標題圖片
            </h3>
        </div>
        <div class="card-body">
            {{ Form::open(['route' => ['title_images.update',$title_image->id], 'method' => 'post', 'files' => true]) }}
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <img src="{{ asset('storage/title_images/'.$title_image->photo_name) }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title"><strong class="text-dark">標題</strong></label>
                            {{ Form::text('title',$title_image->title,['id'=>'title','class' => 'form-control', 'placeholder' => '非必填']) }}
                        </div>
                        <div class="form-group">
                            <label for="content"><strong class="text-dark">說明</strong></label>
                            {{ Form::text('content',$title_image->content,['id'=>'content','class' => 'form-control', 'placeholder' => '非必填']) }}
                        </div>
                        <div class="form-group">
                            <label for="link"><strong class="text-dark">連結</strong></label>
                            {{ Form::text('link',$title_image->link,['id'=>'link','class' => 'form-control', 'placeholder' => '非必填']) }}
                        </div>
                        <div class="form-group">
                            <a href="#" class="btn btn-secondary btn-sm" onclick="history.back()">返回</a>
                            <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('確定儲存嗎？')">
                                <i class="fas fa-save"></i> 修改圖片
                            </button>
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
